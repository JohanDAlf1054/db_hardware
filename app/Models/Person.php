<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Person
 *
 * @property $id
 * @property $rol
 * @property $identification_type
 * @property $identification_number
 * @property $person_type
 * @property $company_name
 * @property $comercial_name
 * @property $first_name
 * @property $other_name
 * @property $surname
 * @property $second_surname
 * @property $digit_verification
 * @property $email_address
 * @property $city
 * @property $address
 * @property $phone
 * @property $status
 * @property $created_at
 * @property $updated_at
 *
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class Person extends Model
{

    public static function staticRules($data=[]){

        $rules = [
            'rol' => 'required',
            'identification_type' => 'required',
            'identification_number' => 'required|string|unique:people,identification_number' . $data['id'],
            'person_type' => 'required',
            'company_name' => 'string|nullable',
            'comercial_name' => 'string|nullable',
            'first_name' => 'string|nullable',
            'other_name' => 'string|nullable',
            'surname' => 'string|nullable',
            'second_surname' => 'string|nullable',
            'digit_verification' => 'required|string',
            'email_address' => 'required|string',
            'city' => 'required|string',
            'address' => 'required|string',
            'phone' => 'required|string',
            'status' => 'nullable',
        ];

        if ($data['identification_number'] == Person::find($data['id'])->identification_number) {
            $rules['identification_number'] = 'required|string';
        }

    return $rules;

    }

    // protected $perPage = 20;

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['rol','identification_type','identification_number','person_type','company_name','comercial_name','first_name','other_name','surname','second_surname','digit_verification','email_address','city','address','phone','status'];



}
