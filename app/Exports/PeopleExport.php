<?php

namespace App\Exports;

use App\Models\Person;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;



class PeopleExport implements FromQuery, WithTitle, WithHeadings
{
    use Exportable;

    protected $role;

    public function __construct($role)
    {
        $this->role = $role;
    }

    public function title(): string
    {
        if ($this->role === 'supplier') {
            return 'Proveedores';
        } elseif ($this->role === 'customer') {
            return 'Clientes';
        } else {
            return 'Personas';
        }
    }

    public function headings(): array
    {
        return [
            'Rol',
            'Tipo de Identificación',
            'Identificación',
            'DV',
            'Razón social',
            'Primer nombre',
            'Otro nombre',
            'Apellido',
            'Segundo apellido',
            'Nombre comercial',
            'Correo electrónico',
            'Ciudad',
            'Dirección',
            'Celular',
            'Estado'
        ];
    }

    public function query()
    {
        if ($this->role === 'supplier') {
            return Person::query()
                ->select('rol', 'identification_type', 'identification_number', 'digit_verification', 'company_name', 'first_name', 'other_name', 'surname', 'second_surname', 'comercial_name', 'email_address', 'city', 'address', 'phone')
                ->where('rol', 'Proveedor');
        } elseif ($this->role === 'customer') {
            return Person::query()
                ->select('rol', 'identification_type', 'identification_number', 'digit_verification', 'company_name', 'first_name', 'other_name', 'surname', 'second_surname', 'comercial_name', 'email_address', 'city', 'address', 'phone')
                ->where('rol', 'Cliente');
        } else {
            return Person::query()
                ->select('rol', 'identification_type', 'identification_number', 'digit_verification', 'company_name', 'first_name', 'other_name', 'surname', 'second_surname', 'comercial_name', 'email_address', 'city', 'address', 'phone')
                ->whereIn('rol', ['proveedor', 'cliente']);
        }
    }
   

   
    
}