<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Municipality extends Model
{
    use HasFactory;

    protected $fillable = [ 'departments_id', 'municipality_id'];

    public function department()
    {
        return $this->belongsTo(Department::class, 'departments_id');
    }

    public function person()
    {
        return $this->hasMany(Person::class, 'municipality_id');
    }



}
