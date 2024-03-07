<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class SubCategory
 *
 * @property $id
 * @property $name
 * @property $description
 * @property $created_at
 * @property $updated_at
 *
 * @property CategoryProduct[] $categoryProducts
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class SubCategory extends Model
{
    
    static $rules = [
		'name' => 'required',
		'description' => 'required',
    ];

    protected $perPage = 20;

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['name','description'];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function categoryProducts()
    {
        return $this->hasMany('App\Models\CategoryProduct', 'sub_categories_id', 'id');
    }
    

}
