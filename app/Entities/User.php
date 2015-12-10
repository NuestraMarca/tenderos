<?php

namespace Tenderos\Entities;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;
use Hash, Auth;
use Storage;
use File;
use Carbon\Carbon;

class User extends Model implements AuthenticatableContract, CanResetPasswordContract
{
    use Authenticatable, CanResetPassword;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'users';
    protected $dates = ['created_at', 'updated_at'];
    protected $appends = ['image', 'type_name'];
    public $timestamp = true;

    /**
     * The system types array.
     *
     * @var array
     */
    private static $singularTypes = ['admin' => 'administrador', 'producer' => 'productor', 'shopkeeper' => 'tendero'];
    private static $pluralTypes = ['admin' => 'administradores', 'producer' => 'productores', 'shopkeeper' => 'tenderos'];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'username', 'tel', 'email', 'address', 'type', 'terms', 'municipality_id', 'password'];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = ['password', 'remember_token'];

    /* Querys */

    public static function allPaginate($number_pages = 10)
    {
        return self::with('type')->orderBy('updated_at')->paginate($number_pages);
    }

    /* Mutators */
    public function setPasswordAttribute($value)
    {
        if (!empty($value)) {
            $this->attributes['password'] = Hash::make(trim($value));
        }
    }

    public function scopeShopkeepers($query)
    {
        return $query->whereType('shopkeeper');
    }

    public function scopeProducers($query)
    {
        return $query->whereType('producer');
    }

    public function scopeAdmins($query)
    {
        return $query->whereType('admin');
    }

    public function scopeWithMessages($query)
    {
        return $query->with([
            'messages' => function($query){
                return $query->whereReceptorId(Auth::user()->id)
                    ->orderBy('created_at', 'asc');
            },
            'receivedMessages' => function($query){
                return $query->whereAuthorId(Auth::user()->id)
                    ->orderBy('created_at', 'asc');
            }
        ]);
    }

    public function scopeExceptId($query, $id)
    {
        return $this->where('id', '<>', $id);
    }

    public function isShopkeeper()
    {
        return $this->isType('shopkeeper');
    }

    public function isAdmin()
    {
        return $this->isType('admin');
    }

    public function isProducer()
    {
        return $this->isType('producer');
    }

    public function isType($type)
    {
        if ($this->type == $type) {
            return true;
        }

        return false;
    }

    public function getTypeNameAttribute()
    {
        return self::$singularTypes[$this->type];
    }

    public function getTypePluralNameAttribute()
    {
        return self::$pluralTypes[$this->type];
    }

    public function getImageAttribute()
    {
        if (Storage::disk('local')->exists('users/'.$this->id.'/profile.jpg')) {
            return '/storage/users/'.$this->id.'/profile.jpg';
        }

        return env('URL_USER_PHOTO_DEMO').'?'.time();
    }

    public function getUpdatedAtHummansAttribute()
    {
        Carbon::setLocale('es');

        return ucfirst($this->updated_at->diffForHumans());
    }

    public function shoppingInterests()
    {
        return $this->belongsToMany(Product::class, 'shopping_interests')
            ->withPivot(['amount', 'unit', 'id']);
    }

    public function shoppingInterestsLists()
    {
        return Product::allLists(null, [], $this->shoppingInterests->lists('id')->all());
    }

    public function productionProducts()
    {
        return $this->belongsToMany(Product::class, 'productions')
            ->withPivot(['months']);
    }

    public function productionProductsLists()
    {
        return Product::allLists(null, [], $this->productionProducts->lists('id')->all());
    }

    public function productions()
    {
        return $this->hasMany(Production::class);
    }

    public function municipality()
    {
        return $this->belongsTo(Municipality::class);
    }

    public function receivedMessages()
    {
        return $this->hasMany(Message::class, 'receptor_id');
    }

    public function getAllMessages()
    {
        return $this->messages->merge($this->receivedMessages)->sortBy('created_at')->values();
    }

    public function messages()
    {
        return $this->hasMany(Message::class, 'author_id');
    }

    public function categoriesCreated()
    {
        return $this->hasMany(Category::class);
    }

    public function uploadImage($file)
    {
        if ($file) {
            $path = 'users/'.$this->id.'/profile.jpg';
            Storage::disk('local')->put($path,  File::get($file));

            return true;
        }

        return false;
    }

    public function acceptTerms()
    {
        $this->terms = true;
        $this->save();
    }

    public static function searchProducers($productId = null, $subregion = null, $months = array())
    {
        $producers = self::with(['productions.product', 'municipality'])->producers()->get();

        if(! is_null($productId)) {
            $producers = $producers->reject(function ($producer) use ($productId) {
                return $producer->productions->whereLoose('product_id', $productId)->isEmpty();
            });
        }

        if(! is_null($subregion) && in_array($subregion, Municipality::$subregions)){
            $producers = $producers->filter(function ($producer) use ($subregion) {
                return $producer->municipality->subregion == $subregion;
            });
        }

        if(! empty($months)){
            $producers = $producers->reject(function ($producer) use ($months) {
                return $producer->productions->filter(function ($production) use ($months) {
                    return $production->existsMonths($months);
                })->isEmpty();
            });
        } 

        return $producers;    
    } 

    public static function searchShopkeepers($productId = null, $municipalities = array())
    {
        $shopkeepers = self::with(['shoppingInterests', 'municipality'])->shopkeepers()->get();

        if(! is_null($productId)) {
            $shopkeepers = $shopkeepers->reject(function ($producer) use ($productId) {
                return $producer->shoppingInterests->whereLoose('id', $productId)->isEmpty();
            });
        }

        if(! empty($municipalities)){
            $shopkeepers = $shopkeepers->filter(function ($producer) use ($municipalities) {
                return in_array($producer->municipality->id, $municipalities);
            });
        } 

        return $shopkeepers;    
    }  

    public static function getOfflineWithMessages()
    {
        return self::whereNotIn('id', Session::getRegisteredUserIds())
            ->withMessages()->get()
            ->reject(function($user){
                return $user->getAllMessages()->isEmpty();
            });           
    } 
}
