<?php

namespace Tenderos\Entities;

use Illuminate\Database\Eloquent\Model;

class Municipality extends Model
{
	/**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name'];
    public static $subregions = ['rio_meta', 'la_macarena', 'area_metropolitana', 'meta_sur', 'piedemonte', 'ariari', 'otra_region'];

    
    public function deparment()
    {
        return $this->belongsTo(Deparment::class);
    }

    public function getNameAttribute($value)
    {
        return ucfirst($value);
    }

    public function getDeparmentNameNameAttribute()
    {
        return $this->deparment->name . ' - ' . $this->name;
    }

    public static function allLists()
    {
        return self::with('deparment')
            ->get()
            ->sortBy('deparment_name_name')
            ->lists('deparment_name_name', 'id')
            ->all();
    }
}
