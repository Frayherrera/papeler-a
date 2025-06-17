<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Log;

class LogPersonalController extends Controller
{


    public function index()
    {
        $ruta = storage_path('logs/personal.log');

        if (!File::exists($ruta)) {
            return view('logs.personal', ['logs' => []]);
        }

        $contenido = File::get($ruta);
        $lineas = explode("\n", trim($contenido));

        $logs = [];

        foreach ($lineas as $linea) {
            preg_match('/\[(.*?)\] (\w+)\.(\w+): (.+?)(\{.*\})?$/', $linea, $partes);

            if (count($partes) >= 4) {
                $logs[] = [
                    'fecha' => $partes[1] ?? '',
                    'canal' => $partes[2] ?? '',
                    'nivel' => strtoupper($partes[3] ?? 'INFO'),
                    'mensaje' => trim($partes[4] ?? ''),
                    'contexto' => isset($partes[5]) ? json_decode($partes[5], true) : [],
                ];
            }
        }

        return view('logs.personal', compact('logs'));
    }
}
