<?php

namespace App\Exports;

use App\Models\Person;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Concerns\WithHeadings;

class PeopleExport implements FromQuery, WithTitle, WithHeadings
{
    use Exportable;

     /**
     * @return string
     */
    public function title(): string
    {
        return 'Personas';
    }

    /**
     * @return array
     */
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
            'Celular'
        ];
    }

    /**
     * @return \Illuminate\Support\Collection
     */
    public function query()
    {
        return Person::query()
            ->select('rol', 'identification_type', 'identification_number', 'digit_verification', 'company_name', 'first_name', 'other_name', 'surname', 'second_surname', 'comercial_name', 'email_address', 'city', 'address', 'phone');
    }
}
