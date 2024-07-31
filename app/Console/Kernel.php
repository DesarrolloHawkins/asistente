<?php

namespace App\Console;

use App\Models\Client;
use App\Models\Mensaje;
use Carbon\Carbon;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     */
    protected function schedule(Schedule $schedule): void
    {
        // $schedule->command('inspire')->hourly();
        $schedule->call(function () {
            // Obtener la fecha de hoy
            $hoy = Carbon::now();
            // Obtenemos la reservas que sean igual o superior a la fecha de entrada de hoy y no tengan el DNI Enrtegado.
           // $clientes = Client::where('send', null)
            // ->where('id', 13)
          //  ->orderBy('id', 'asc')
            // ->where('estado_id', 1)
            // ->where('fecha_entrada', '>=', $hoy->toDateString())
            //->take(10)
            //->get();
			
			$phones =[
				'659594307','659903047'
			];

            foreach($phones as $phone){
                $envioMensaje = $this->autoMensajeWhatsappTemplate('34'.$phone, 'pepe', 'kit_digital_10');
                $id = $envioMensaje['messages'][0]['id'];
                // "{
                //     \"messaging_product\":\"whatsapp\",
                //     \"contacts\":[
                //         {
                //             \"input\":\"3434605621704\",
                //             \"wa_id\":\"3434605621704\"
                //         }
                //     ],
                //     \"messages\":[
                //         {
                //             \"id\":\"wamid.HBgNMzQzNDYwNTYyMTcwNBUCABEYEkMwM0ZCRkQxNDYyMDYwMzQ4QwA=\",
                //             \"message_status\":\"accepted\"
                //         }
                //     ]
                // }";

                $mensaje = 'Buenas tardes!
							Me llamo Hera y te escribo de Hawkins, tu agente digitalizador para las subvenciones del kit digital.
							Te escribo principalmente para continuar con tu subvención. Quieres que te llamemos mañana y avancemos con tu 								proyecto? Quedo a la espera, Gracias!';

                $dataRegistrar = [
                    'id_mensaje' => $id,
                    'id_three' => null,
                    'remitente' => '34'.$phone,
                    'mensaje' => null,
                    'respuesta' => $mensaje,
                    'status' => 1,
                    'status_mensaje' => 1,
                    'type' => 'text',
                    'is_automatic' => true,
                    'date' => Carbon::now()
                ];
                $mensajeCreado = Mensaje::create($dataRegistrar);
                //$client->send = true;
                //$client->save();
            }
            Log::info("Tarea programada de Envio Mesanje ClienteVip auto al cliente ejecutada con éxito.");
        })->everyMinute();
    }

    /**
     * Register the commands for the application.
     */
    protected function commands(): void
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }

    public function autoMensajeWhatsappTemplate($phone, $client, $template)
    {
        $token = env('TOKEN_WHATSAPP', 'valorPorDefecto');
        $urlMensajes = 'https://graph.facebook.com/v18.0/254315494430032/messages';

        $mensajePersonalizado = [
            "messaging_product" => "whatsapp",
            "recipient_type" => "individual",
            "to" => $phone,
            "type" => "template",
            "template" => [
                "name" => $template,
                // "name" => 'cliente-vip',
                "language" => [
                    "code" => 'es_ES'
                ],
                /*"components" => [
                    [
                        "type" => 'body',
                        "parameters" => [
                            ["type" => "text", "text" => $client],
                        ],
                    ]
                ]*/
            ]
        ];

        $curl = curl_init();

        curl_setopt_array($curl, [
            CURLOPT_URL => $urlMensajes,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => json_encode($mensajePersonalizado),
            CURLOPT_HTTPHEADER => [
                'Content-Type: application/json',
                'Authorization: Bearer ' . $token
            ],
        ]);

        $response = curl_exec($curl);
        curl_close($curl);
        $responseJson = json_decode($response, true);

        Storage::disk('local')->put('Respuesta_Envio_Whatsapp-'.$phone.'.txt', json_encode($response));
        return $responseJson;
    }
}
