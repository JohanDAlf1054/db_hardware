<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class credit_note_sales extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function cliente(){
        return $this->belongsTo(Person::class);
    }

    public function productos(){
        return $this->belongsToMany(Product::class)->withTimestamps()
        ->withPivot('references','amount','selling_price','discounts','tax');
    }
}
