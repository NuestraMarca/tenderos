<?php

namespace Tenderos\Entities;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Session as SessionFacade;
use Illuminate\Database\Eloquent\Builder;
use Auth;

class Session extends Model 
{
    /**
     * {@inheritdoc}
     */
    public $table = 'sessions';

    /**
     * {@inheritdoc}
     */
    public $timestamps = false;

    /**
     * Returns the user that belongs to this entry.
     *
     * @return Tenderos\Entities\User
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Returns all the users within the given activity.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @param  int  $limit
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeActivity($query, $limit = 10)
    {
        $lastActivity = strtotime(Carbon::now()->subMinutes($limit));

        return $query->where('last_activity', '>=', $lastActivity);
    }

    /**
     * Returns all the guest users.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeGuests(Builder $query)
    {
        return $query->whereNull('user_id');
    }

    /**
     * Returns all the registered users.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeRegistered(Builder $query)
    {
        return $query->whereNotNull('user_id')->groupBy('user_id');
    }

    /**
     * Returns all the registered users.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeWithUserMessages(Builder $query)
    {
        return $query->with([
            'user.messages' => function($query){
                return $query->whereReceptorId(Auth::user()->id)
                    ->orderBy('created_at', 'asc');
            },
            'user.receivedMessages' => function($query){
                return $query->whereAuthorId(Auth::user()->id)
                    ->orderBy('created_at', 'asc');
            }
        ]);
    }

    public static function getRegisteredUserIds()
    {
        return self::registered()->get()->lists('user_id');
    }

    
    /**
     * Updates the session of the current user.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeUpdateCurrent(Builder $query)
    {
        $user = Auth::user();

        return $query->where('id', SessionFacade::getId())->update([
            'user_id' => $user ? $user->id : null
        ]);
    }

    /**
     * Updates the session of the current user.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeLogoutCurrent(Builder $query)
    {
        return $query->where('id', SessionFacade::getId())->update([
            'user_id' => null
        ]);
    }
}