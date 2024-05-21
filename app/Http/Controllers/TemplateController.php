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

    public function downloadFileCategory()
    {
        $filePath = storage_path('app/public/template/planilla_importar_categorías.xlsx');
        return response()->download($filePath);
    }

    public function downloadFileBrands()
    {
        $filePath = storage_path('app/public/template/planilla_importar_marcas.xlsx');
        return response()->download($filePath);
    }

    public function downloadFileUnits()
    {
        $filePath = storage_path('app/public/template/planilla_importar_unidades.xlsx');
        return response()->download($filePath);
    }
}