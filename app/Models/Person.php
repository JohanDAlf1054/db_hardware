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

    public static $rules = [
		'rol' => 'required',
		'identification_type' => 'required',
		'identification_number' => 'required|string|unique:people,identification_number',
		'person_type' => 'required',
		'company_name' => 'string|nullable|unique:people,company_name',
        'comercial_name' => 'string|nullable|unique:people,comercial_name',
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

    //Funcion para sobreescribir la regla segun la seleccion en tipo de persona.
    public static function boot()
    {
        parent::boot();

        static::saving(function ($model) {
            if ($model->person_type === 'Persona natural') {
                $model::$rules['first_name'] = 'required|string';
                $model::$rules['other_name'] = 'nullable|string';
                $model::$rules['surname'] = 'required|string';
                $model::$rules['second_surname'] = 'required|string';
                $model::$rules['company_name'] = 'nullable|string';
            } elseif ($model->person_type === 'Persona jurídica') {
                $model::$rules['company_name'] = 'required|string';
                $model::$rules['first_name'] = 'nullable|string';
                $model::$rules['other_name'] = 'nullable|string';
                $model::$rules['surname'] = 'nullable|string';
                $model::$rules['second_surname'] = 'nullable|string';

            }
        });
    }


    protected $perPage = 20;

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['rol','identification_type','identification_number','person_type','company_name','comercial_name','first_name','other_name','surname','second_surname','digit_verification','email_address','city','address','phone','status'];



}
