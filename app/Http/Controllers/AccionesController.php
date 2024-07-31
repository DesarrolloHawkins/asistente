<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

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
}
