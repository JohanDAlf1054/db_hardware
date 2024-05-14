<?php

namespace App\Imports;

use App\Models\Person;
use Maatwebsite\Excel\Concerns\ToModel;

use function Ramsey\Uuid\v1;

class PersonImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Person([
            'rol' => $row['Tercero'],
            'identification_type'=>  $row['Tipo Ientificación'],
            'identification_number' => $row['Número de Identificación'],
            'digit_verification'=>  $row['Digito de verificación'],
            'company_name '=> $row['Razón social'],
            'first_name'=> $row['Primer nombre'],
            'other_name'=> $row['Otro nombre'],
            'surname'=> $row['Apellido'],
            'second_surname'=> $row['Segundo apellid'],
            'comercial_name'=> $row['Nombre comercial'],
            'email_address'=> $row['Correo electrónico'],
            'city'=> $row['Ciudad'],
            'address'=> $row['Dirección'],
            'phone'=> $row['Celular']
        ]);
    }
}
