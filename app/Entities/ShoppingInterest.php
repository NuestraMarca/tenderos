<?php

namespace Tenderos\Entities;

use Illuminate\Database\Eloquent\Model;

class ShoppingInterest extends Model
{
    protected $fillable = ['product_id', 'user_id', 'amount', 'unit'];
}
