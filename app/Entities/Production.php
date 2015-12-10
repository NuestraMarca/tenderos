<?php

namespace Tenderos\Entities;

use Illuminate\Database\Eloquent\Model;

class Production extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['user_id', 'product_id', 'months'];
    protected $appends = ['months_names_array'];
    protected $dates = ['created_at', 'updated_at'];
    public static $months = [
        1 => 'Enero', 2 => 'Febrero', 3 => 'Marzo', 4 => 'Abril', 5 => 'Mayo', 6 => 'Junio', 
        7 => 'Julio', 8 => 'Agosto', 9 => 'Septiembre', 10 => 'Octubre', 11 => 'Noviembre', 12 => 'Diciembre'
    ];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function getMonthsNamesArrayAttribute()
    {   
        $monthsNames = [];

        foreach ($this->getMonthsCollection() as $monthId) {
            $monthsNames[$monthId] = self::$months[$monthId];
        }

        return $monthsNames;
    }

    public function getMonthsNamesAttribute()
    {   
        return implode(', ', $this->months_names_array);
    }

    public function setMonthsAttribute($value)
    {   
        $this->attributes['months'] = implode(',', $value);
    }

    

    public function getMonthsCollection()
    {
        return collect(explode(',', $this->months));
    }

    public function existsMonths(array $months)
    {        
        return ! $this->getMonthsCollection()->intersect($months)->isEmpty();
    }

}
