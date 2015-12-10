<?php

namespace Tenderos\Entities;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name'];
    
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function getNameAttribute($value)
    {
        return ucfirst($value);
    }

    public function getCategoryNameNameAttribute()
    {
        return $this->category->name . ' - ' . $this->name;
    }

    public function scopeLikeName($query, $name)
    {
        return $query->where('name', 'like', '%'.$name.'%');
    }

    public static function allLists($name = '', array $execptProductIds = array(), array $onlyProductIds = null)
    {
        $products = self::with('category')
            ->likeName($name)
            ->whereNotIn('id', $execptProductIds);

        if(!is_null($onlyProductIds)){
            $products = $products->whereIn('id', $onlyProductIds);    
        }
        
        $products = $products->get()
            ->sortBy('category_name_name')
            ->lists('category_name_name', 'id')
            ->all();

        return $products;
    } 

}
