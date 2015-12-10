<?php

namespace Tenderos\Entities;

use Illuminate\Database\Eloquent\Model;

class Deparment extends Model
{
	/**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name'];

    public function municipalities()
    {
        return $this->hasMany(Municipality::class);
    }

    public function getNameAttribute($value)
    {
        return ucfirst($value);
    }
}
