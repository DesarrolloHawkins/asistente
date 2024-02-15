<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class WhatsappController extends Controller
{

    public function hookWhatsapp(Request $request) {
        $responseJson = env('WHATSAPP_KEY', 'valorPorDefecto');

            $query = $request->all();
            $mode = $query['hub_mode'];
            $token = $query['hub_verify_token'];
            $challenge = $query['hub_challenge'];

            // Formatear la fecha y hora actual
            $dateTime = Carbon::now()->format('Y-m-d_H-i-s'); // Ejemplo de formato: 2023-11-13_15-30-25

            // Crear un nombre de archivo con la fecha y hora actual
            $filename = "hookWhatsapp_{$dateTime}.txt";

            Storage::disk('local')->put($filename, json_encode($request->all()));

            return response($challenge, 200)->header('Content-Type', 'text/plain');
    }

    public function processHookWhatsapp(Request $request) {

        $data = json_decode($request->getContent(), true);
        $fecha = Carbon::now()->format('Y-m-d_H-i-s');
        Storage::disk('local')->put('Mensaje_Reicibidos-'.$fecha.'.txt', json_encode($data) );

        // $id = $data['entry'][0]['changes'][0]['value']['messages'][0]['id'];
        return response(200)->header('Content-Type', 'text/plain');
        // $tipo = $data['entry'][0]['changes'][0]['value']['messages'][0]['type'];

        // if ($tipo == 'audio') {

        //     $idMedia = $data['entry'][0]['changes'][0]['value']['messages'][0]['audio']['id'];
        //     $phone = $data['entry'][0]['changes'][0]['value']['messages'][0]['from'];

        //     Storage::disk('local')->put('audio-'.$idMedia.'.txt', json_encode($data) );

        //     $url = str_replace('/\/', '/', $this->obtenerAudio($idMedia));

        //     Storage::disk('local')->put('url-'.$idMedia.'.txt', $url );

        //     $fileAudio = $this->obtenerAudioMedia($url,$idMedia);

        //     // Storage::disk('local')->put('Conversion-'.$idMedia.'.txt', $fileAudio  );
        //     $file = Storage::disk('public')->get( $idMedia.'.ogg');

        //     $SpeechToText = $this->audioToText($file);


        //     // if (isset(json_decode($SpeechToText)[0]['DisplayText'])) {
        //     //     # code...
        //     // }
        //     Storage::disk('local')->put('phone-'.$idMedia.'.txt', $phone );

        //     Storage::disk('local')->put('transcripcion-'.$idMedia.'.txt', $SpeechToText );

        //     $reponseChatGPT = $this->chatGpt($SpeechToText);
        //     Storage::disk('local')->put('reponseChatGPT-'.$idMedia.'.txt', $reponseChatGPT );

        //     $respuestaWhatsapp = $this->contestarWhatsapp($phone, $reponseChatGPT['messages']);
        //     Storage::disk('local')->put('respuestaWhatsapp-'.$idMedia.'.txt', $respuestaWhatsapp );

        //     $dataRegistrarChat = [
        //         'id_mensaje' => $data['entry'][0]['changes'][0]['value']['messages'][0]['id'],
        //         'remitente' => $data['entry'][0]['changes'][0]['value']['contacts'][0]['wa_id'],
        //         'mensaje' => $SpeechToText,
        //         'respuesta' => str_replace('"','',$reponseChatGPT['messages'] ),
        //         'status' => 1,
        //         'type' => 'audio'
        //     ];
        //     ChatGpt::create( $dataRegistrarChat );

        //     return response('ok', 200);
        // }

        // else if ($tipo == 'image') {
        //     $mensajeExiste = ChatGpt::where('id_mensaje', $data['entry'][0]['changes'][0]['value']['messages'][0]['id'])->first();
        //     $phone = $data['entry'][0]['changes'][0]['value']['messages'][0]['from'];

        //     if ($mensajeExiste == null) {

        //         $idMedia = $data['entry'][0]['changes'][0]['value']['messages'][0]['image']['id'];

        //         Storage::disk('local')->put('image-'.$idMedia.'.txt', json_encode($data) );

        //         $url = $this->obtenerImage($idMedia);

        //         $urlMedia = str_replace('\/', '/', $url );

        //         Storage::disk('local')->put('image-response-url-'.$idMedia.'.txt', $urlMedia );
        //         // $url = str_replace('/\/', '/', $this->obtenerAudio($idMedia));

        //         $descargarImage = $this->descargarImage($urlMedia,$idMedia );

        //         if ($descargarImage == true) {

        //         }

        //         $responseImage = 'Gracias!! recuerda que soy una inteligencia artificial y que no puedo ver lo que me has enviado pero mi supervisora María lo verá en el horario de 09:00 a 18:00 de Lunes a viernes. Si es tu DNI o Pasaporte es suficiente con enviármelo a mi. Mi supervisora lo recibirá. Muchas gracias!!';

        //         $respuestaWhatsapp = $this->contestarWhatsapp($phone, $responseImage);

        //         $dataRegistrarChat = [
        //             'id_mensaje' => $data['entry'][0]['changes'][0]['value']['messages'][0]['id'],
        //             'remitente' => $data['entry'][0]['changes'][0]['value']['contacts'][0]['wa_id'],
        //             'mensaje' => $data['entry'][0]['changes'][0]['value']['messages'][0]['image']['id'],
        //             'respuesta' => $responseImage,
        //             'status' => 1,
        //             'type' => 'image'
        //         ];
        //         ChatGpt::create( $dataRegistrarChat );

        //     }


        // }

        // else {

        //     // Storage::disk('local')->put('data-'.$id.'.txt', json_encode($data) );

        //     Whatsapp::create(['mensaje' => json_encode($data)]);
        //     $phone = $data['entry'][0]['changes'][0]['value']['messages'][0]['from'];
        //     $mensaje = $data['entry'][0]['changes'][0]['value']['messages'][0]['text']['body'];
        //     Storage::disk('local')->put('comprobar-'.$id.'.txt', json_encode($data) );
        //     Storage::disk('local')->put('example-'.$id.'.txt', json_encode($data) );

        //         $mensajeExiste = Mensaje::where('id_mensaje', $data['entry'][0]['changes'][0]['value']['messages'][0]['id'] )->get();

        //         if (count($mensajeExiste) > 0) {

        //         }else{
        //             $dataRegistrar = [
        //                 'id_mensaje' => $data['entry'][0]['changes'][0]['value']['messages'][0]['id'],
        //                 'remitente' => $data['entry'][0]['changes'][0]['value']['contacts'][0]['wa_id'],
        //                 'mensaje' => $data['entry'][0]['changes'][0]['value']['messages'][0]['text']['body'],
        //                 'status' => 1
        //             ];

        //             Mensaje::create($dataRegistrar);

        //             $value = $data['entry'][0]['changes'][0]['value']['messages'][0]['text']['body'];

        //             $reponseChatGPT = $this->chatGpt($value);

        //             Storage::disk('local')->put('response'.$id.'.txt', $reponseChatGPT['messages'] );

        //             $dataRegistrarChat = [
        //                 'id_mensaje' => $data['entry'][0]['changes'][0]['value']['messages'][0]['id'],
        //                 'remitente' => $data['entry'][0]['changes'][0]['value']['contacts'][0]['wa_id'],
        //                 'mensaje' => $data['entry'][0]['changes'][0]['value']['messages'][0]['text']['body'],
        //                 'respuesta' => str_replace('"','',$reponseChatGPT['messages'] ),
        //                 'status' => 1
        //             ];
        //             ChatGpt::create( $dataRegistrarChat );

        //             $respuestaWhatsapp = $this->contestarWhatsapp($phone, $reponseChatGPT['messages']);

        //             return response(200)->header('Content-Type', 'text/plain');

        //         }
        //     if (str_word_count($data['entry'][0]['changes'][0]['value']['messages'][0]['text']['body']) > 1) {
        //         Storage::disk('local')->put('example-'.$id.'.txt', json_encode($data) );

        //         $mensajeExiste = Mensaje::where('id_mensaje', $data['entry'][0]['changes'][0]['value']['messages'][0]['id'] )->get();

        //         if (count($mensajeExiste) > 0) {

        //         }else{
        //             $dataRegistrar = [
        //                 'id_mensaje' => $data['entry'][0]['changes'][0]['value']['messages'][0]['id'],
        //                 'remitente' => $data['entry'][0]['changes'][0]['value']['contacts'][0]['wa_id'],
        //                 'mensaje' => $data['entry'][0]['changes'][0]['value']['messages'][0]['text']['body'],
        //                 'status' => 1
        //             ];

        //             Mensaje::create($dataRegistrar);

        //             $value = $data['entry'][0]['changes'][0]['value']['messages'][0]['text']['body'];

        //             $reponseChatGPT = $this->chatGpt($value);

        //             Storage::disk('local')->put('response'.$id.'.txt', $reponseChatGPT['messages'] );

        //             $dataRegistrarChat = [
        //                 'id_mensaje' => $data['entry'][0]['changes'][0]['value']['messages'][0]['id'],
        //                 'remitente' => $data['entry'][0]['changes'][0]['value']['contacts'][0]['wa_id'],
        //                 'mensaje' => $data['entry'][0]['changes'][0]['value']['messages'][0]['text']['body'],
        //                 'respuesta' => str_replace('"','',$reponseChatGPT['messages'] ),
        //                 'status' => 1
        //             ];
        //             ChatGpt::create( $dataRegistrarChat );

        //             $respuestaWhatsapp = $this->contestarWhatsapp($phone, $reponseChatGPT['messages']);

        //             return response(200)->header('Content-Type', 'text/plain');

        //         }
        //     }

        //     return response(200)->header('Content-Type', 'text/plain');
        // }

    }

    public function chatGptPruebas(Request $request) {

    }

}
