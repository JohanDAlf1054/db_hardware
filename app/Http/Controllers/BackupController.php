<?php

namespace App\Http\Controllers;

use App\Jobs\BackupAll;
use Illuminate\Http\Request;
use App\Jobs\BackupProcess;
Use Illuminate\Support\Facades\Session;

class BackupController extends Controller
{
    public function backup(){
        BackupProcess::dispatch();
        Session::flash('notificacion', [
            'tipo' => 'exito',
            'titulo' => 'Éxito!',
            'descripcion' => 'Copia de Seguridad Creada!',
            'autoCierre' => 'true'
        ]);
        return redirect()->back();
    }

    public function backupSystem(){
        BackupAll::dispatch();
        Session::flash('notificacion', [
            'tipo' => 'exito',
            'titulo' => 'Éxito!',
            'descripcion' => 'Copia de Seguridad de todo el sistema Creada!',
            'autoCierre' => 'true'
        ]);
        return redirect()->back();
    }
}
