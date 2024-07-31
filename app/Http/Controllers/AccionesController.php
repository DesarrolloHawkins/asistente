<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;
use App\Models\Mensaje;
use Carbon\Carbon;



class AccionesController extends Controller
{
    public function index(){
        $estados = [
            ['id' => 1, 'name' => 'CANCELADO PARA SIEMPRE'],
            ['id' => 2, 'name' => 'TRAMITADA'],
            ['id' => 3, 'name' => 'APORTAR DOCUMENTACION'],
            ['id' => 4, 'name' => 'ACEPTADA'],
            ['id' => 5, 'name' => 'ACEPTADA - ACUERDO VALIDADO'],
            ['id' => 6, 'name' => 'CANCELADA'],
            ['id' => 7, 'name' => 'PRODUCCION'],
            ['id' => 8, 'name' => 'JUSTIFICADO'],
            ['id' => 9, 'name' => 'JUSTIFICADO PARCIAL'],
            ['id' => 10, 'name' => 'VALIDADA'],
            ['id' => 11, 'name' => 'PAGADA'],
            ['id' => 12, 'name' => 'PENDIENTE SUBSANAR 1'],
            ['id' => 13, 'name' => 'PENDIENTE SUBSANAR 2'],
            ['id' => 14, 'name' => 'SUBSANADO 1'],
            ['id' => 15, 'name' => 'SUBSANADO 2'],
            ['id' => 16, 'name' => 'CANCELADA POR VENCIMIENTO'],
            ['id' => 17, 'name' => 'RECUPERACION'],
            ['id' => 18, 'name' => 'LEADS'],
            ['id' => 19, 'name' => 'NO PAGADA POR PROBLEMAS DE HACIENDA'],
            ['id' => 20, 'name' => 'PENDIENTE SEGUNDA JUSTIFICACIÓN'],
            ['id' => 21, 'name' => 'SEGUNDA JUSTIFICACIÓN (REALIZADA)'],
            ['id' => 22, 'name' => 'PAGADA 2º JUSTIFICACIÓN'],
            ['id' => 23, 'name' => 'PENDIENTE DE TRAMITAR'],
            ['id' => 24, 'name' => 'INTERESADOS'],
            ['id' => 25, 'name' => 'VALIDADAS 2ª JUSTIFICACION'],
        ];
        return view('acciones.index', compact('estados'));
    }
    public function enviar(){
        $estados = [
            ['id' => 1, 'name' => 'CANCELADO PARA SIEMPRE'],
            ['id' => 2, 'name' => 'TRAMITADA'],
            ['id' => 3, 'name' => 'APORTAR DOCUMENTACION'],
            ['id' => 4, 'name' => 'ACEPTADA'],
            ['id' => 5, 'name' => 'ACEPTADA - ACUERDO VALIDADO'],
            ['id' => 6, 'name' => 'CANCELADA'],
            ['id' => 7, 'name' => 'PRODUCCION'],
            ['id' => 8, 'name' => 'JUSTIFICADO'],
            ['id' => 9, 'name' => 'JUSTIFICADO PARCIAL'],
            ['id' => 10, 'name' => 'VALIDADA'],
            ['id' => 11, 'name' => 'PAGADA'],
            ['id' => 12, 'name' => 'PENDIENTE SUBSANAR 1'],
            ['id' => 13, 'name' => 'PENDIENTE SUBSANAR 2'],
            ['id' => 14, 'name' => 'SUBSANADO 1'],
            ['id' => 15, 'name' => 'SUBSANADO 2'],
            ['id' => 16, 'name' => 'CANCELADA POR VENCIMIENTO'],
            ['id' => 17, 'name' => 'RECUPERACION'],
            ['id' => 18, 'name' => 'LEADS'],
            ['id' => 19, 'name' => 'NO PAGADA POR PROBLEMAS DE HACIENDA'],
            ['id' => 20, 'name' => 'PENDIENTE SEGUNDA JUSTIFICACIÓN'],
            ['id' => 21, 'name' => 'SEGUNDA JUSTIFICACIÓN (REALIZADA)'],
            ['id' => 22, 'name' => 'PAGADA 2º JUSTIFICACIÓN'],
            ['id' => 23, 'name' => 'PENDIENTE DE TRAMITAR'],
            ['id' => 24, 'name' => 'INTERESADOS'],
            ['id' => 25, 'name' => 'VALIDADAS 2ª JUSTIFICACION'],
        ];
        return view('acciones.enviar', compact('estados'));
    }

    public function enviarMensajes(Request $request){  
        
        $categoria = $request->categoria;
        // Realiza la solicitud HTTP para obtener los teléfonos usando cURL
        $curl = curl_init();

        curl_setopt_array($curl, [
            CURLOPT_URL => 'https://crmhawkins.com/getAyudas',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => json_encode(['estado' => $categoria]),
            CURLOPT_HTTPHEADER => [
                'Content-Type: application/json'
            ],
        ]);

        $response = curl_exec($curl);
        curl_close($curl);

        $data = json_decode($response, true);

        // dd($data['ayudas']);

        // $data = $response->json();

        $phones = [];
        foreach ($data['ayudas'] as $item) {
            if (isset($item['telefono'])) {
                // Eliminar espacios del número de teléfono
                $cleanedPhone = preg_replace('/\s+/', '', $item['telefono']);
                if (preg_match('/^\d{9}$/', $cleanedPhone)) {
                    $phones[] = [
                        'id' =>  $item['id'],
                        'phone' => $cleanedPhone
                    ];
                }
            }
        }
        $phones = array_unique($phones, SORT_REGULAR);

        //dd($phones);

        $phones = [
            [
                'id' =>  7405,
                'phone' => '605621704'
            ],
            [
                'id' =>  7405,
                'phone' => '622440984'
            ],
            [
                'id' =>  7405,
                'phone' => '626264646'
            ],
        ];
        foreach($phones as $entry){
            $phone = $entry['phone'];
            $envioMensaje = $this->autoMensajeWhatsappTemplate('34'.$phone, 'kit_digital_10');
            $id = $envioMensaje['messages'][0]['id'];

            $mensaje = 'Buenas tardes!
                        Me llamo Hera y te escribo de Hawkins, tu agente digitalizador para las subvenciones del kit digital.
                        Te escribo principalmente para continuar con tu subvención. Quieres que te llamemos mañana y avancemos con tu proyecto? Quedo a la espera, Gracias!';

            $dataRegistrar = [
                'id_mensaje' => $id,
                'id_three' => null,
                'remitente' => '34'.$phone,
                'mensaje' => $mensaje,
                'respuesta' => null,
                'status' => 1,
                'status_mensaje' => 1,
                'type' => 'text',
                'is_automatic' => true,
                'ayuda_id' => $entry['id'],
                'date' => Carbon::now()
            ];
            $mensajeCreado = Mensaje::create($dataRegistrar);
        }
    }

    public function autoMensajeWhatsappTemplate($phone, $template)
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
