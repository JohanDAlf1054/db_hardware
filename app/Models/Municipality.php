<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Municipality extends Model
{
    use HasFactory;

    protected $fillable = ['code', 'name', 'departments_id'];

    public function department()
    {
        return $this->belongsTo(Department::class);
    }

    public function person()
    {
        return $this->hasMany('App\Models\Person','municipality','id');
    }
}
