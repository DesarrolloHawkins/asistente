<?php

namespace App\Http\Controllers;

use App\Models\Client;
use League\Csv\Reader; // Usaremos la biblioteca League\Csv para leer el archivo CSV
use Illuminate\Http\Request;

class ClientsController extends Controller
{
    public function create(){
        // Define la ruta del archivo CSV
        $csvPath = public_path('clientes.csv');

        // Abrir el archivo CSV
        $fileHandle = fopen($csvPath, 'r');
        if (!$fileHandle) {
            return redirect()->back()->with('error', 'No se pudo abrir el archivo CSV.');
        }

        // Leer la primera línea y descartarla si es el encabezado
        fgetcsv($fileHandle);

        // Iterar sobre cada línea del archivo CSV
        while (($row = fgetcsv($fileHandle)) !== false) {
            // Asumiendo que la primera columna es 'name' y la segunda es 'phone'
            $name = $row[0];
            $phone = $row[1];

            // Usar 'firstOrCreate' para insertar el cliente si no existe basado en el teléfono
            Client::firstOrCreate(
                ['phone' => $phone], // Condición para buscar/existir
                ['name' => $name, 'phone' => $phone] // Datos para crear si no existe
            );
        }

        // Cerrar el archivo
        fclose($fileHandle);

        // Redireccionar de vuelta o a donde sea necesario después de procesar el archivo
        return redirect()->back()->with('success', 'Clientes importados exitosamente.');
    }
}
