<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class TemplateController extends Controller
{
    public function downloadFile()
    {
        $filePath = storage_path('app/public/template/personas-plantilla.xlsx');
        return response()->download($filePath);
    }
}