<?php

namespace Tenderos\Entities;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
	/**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['text', 'author_id', 'receptor_id'];

    public function author()
    {
        return $this->belongsTo(User::class, 'author_id');
    }

    public function receptor()
    {
        return $this->belongsTo(User::class, 'receptor_id');
    }
}
