<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class CategoryProduct
 *
 * @property $id
 * @property $name
 * @property $description
 * @property $sub_categories_id
 * @property $created_at
 * @property $updated_at
 *
 * @property Product[] $products
 * @property SubCategory $subCategory
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class CategoryProduct extends Model
{
    
    static $rules = [
		'name' => 'required',
		'description' => 'required',
		'sub_categories_id' => 'required',
    ];

    protected $perPage = 20;

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['name','description','sub_categories_id'];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function products()
    {
        return $this->hasMany('App\Models\Product', 'category_products_id', 'id');
    }
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function subCategory()
    {
        return $this->hasOne('App\Models\SubCategory', 'id', 'sub_categories_id');
    }
    

}
