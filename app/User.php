<?php

namespace App;

use App\Traits\Coverable;
use App\Traits\Avatarable;
use App\Traits\Guidable;

use Modules\Media\Models\Media;
use Modules\Store\Models\Publisher;

use Illuminate\Support\Arr;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Contracts\Support\Arrayable;

use Cedu\Mongodb\Auth\User as Authenticatable; 

class User extends Authenticatable
{
    use SoftDeletes;
    use Notifiable;

    use Avatarable;
    use Coverable;
    use Guidable;

    /**
     * Define user status value
     */
    const STATUS_DELETED    = -2;
    const STATUS_BLOCKED    = -1;
    const STATUS_VERIFIED   = 0;
    const STATUS_ACTIVE     = 1;

    /**
     * Override datetime field name
     */
    const CREATED_AT = 'created';
    const UPDATED_AT = 'updated';
    const DELETED_AT = 'deleted';

    /**
     * Model mongo connection
     */
    protected $connection = 'mongodb';
    protected $collection = 'sys.users';

    protected $rememberTokenName = 'remember';

    protected $permissions = [];

    /**
     * The attributes that are date format.
     *
     * @var array
     */
    protected $dates = [
        'birthday',
        'verified'
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        '_id',
        'pid',          // Publisher id
        'name', 
        'email', 
        'password', 
        'gender', 
        'avatar',
        'cover',
        'location',     // Location object [location{name, mobile, lat,long, city, address}]
        'publisher',    // Publisher embeded object {}  
        'payment',      // Payment object
        'mobile', 
        'birthday',
        'about',
        'roles',
        'status',
        'verified',
        'deleted',
    ];

    /**
     * The model's default values for attributes.
     *
     * @var array
     */
    protected $attributes = [

    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember',
    ];

    /**
     * The attributes that should be cast to native types.
     * @link(https://laravel.com/docs/5.8/eloquent-mutators#attribute-casting)
     * @var array
     */
    protected $casts = [
        'status' => 'int',
        'birthday' => 'datetime',
        'deleted' => 'datetime',
        'verified' => 'datetime',
    ];

    /**
     * Check user has role with name
     * @example Auth::has('admin')
     * @example Auth::user()->has('admin')
     */
    public function has($role)
    {
        if (isset($this->roles) && is_array($this->roles) && in_array($role, $this->roles)) {
            return true;
        }
        return false;
    }

    /**
     * Check user has perm with name
     * @example Auth::hasPerm('backend.admin')
     * @example Auth::user()->hasPerm('backend.admin')
     */
    public function hasPerm($name)
    {
        return isset($this->perms[$name]);
    }

    public function getRememberTokenName()
    {
        return $this->rememberTokenName;
    }

    /**
     * Get current user embedded data
     * @example $order->customer = $user->getEmbedded()
     */
    public function getEmbedded()
    {
        $fillable = [
            'id',
            'name', 
            'avatar',
        ];

        $node = new User();
        $node->timestamps = false;
        
        foreach($fillable as $field) {
            $value = $this->{$field};
            if ($value instanceof Arrayable) {
                $node->{$field} = $value->toArray();
            } else {
                $node->{$field} = $value;
            }
        }

        return $node;
    }

    /**
     * Add embedded publisher object
     * @example $user->publisher->id
     * @example $user->publisher->avatar->thumb
     * @example $user->publisher->cover->thumb
     */
    public function publisher()
    {
        return $this->hasOne('Modules\Store\Models\Publisher', '_id', 'pid');
    }

    /**
     * Add custom attribute to get publisher or create new instance
     * @example $user->publisherOrCreate
     * @return object
     */
    public function getPublisherOrCreateAttribute()
    {
        return $this->publisher ?? new Publisher();
    }

    /**
     * Get user primary role
     * @example $user->role
     * @return string
     */
    public function getRoleAttribute()
    {
        return reset($this->roles) ?? 'user';
    }

    /**
     * Add custom attribute to get user list permissions
     * @example $user->perms
     * @return array
     */
    public function getPermsAttribute()
    {
        if (empty($this->permissions) == false) {
            return $this->permissions;
        }

        // Resolve roles database
        $roles = resolve('roles');

        // Get current user roles and perms
        $list = Arr::only($roles, $this->roles);

        // Merge user roles to perms
        $this->permissions = [];

        foreach($list as $item) {
            $this->permissions = array_merge($this->permissions, $item);
        }

        ksort($this->permissions);

        return $this->permissions;
    }

    /**
     * Get current user city location
     * @example $user->city
     * @return array
     */
    public function getCityAttribute()
    {
        return $this->location['city'] ?? 'N/A';
    }

    /**
     * Get current user address location
     * @example $user->address
     * @return array
     */
    public function getAddressAttribute()
    {
        return $this->location['address'] ?? 'N/A';
    }

    public static function getCollection($bucket = null)
    {
        $collection = [
            'status' => [
                '-2' => 'Deleted',
                '-1' => 'Blocked',
                '0' => 'Verified',
                '1' => 'Active'
            ],
            'gender' => [
                'male' => 'Male',
                'female' => 'Female',
            ],
        ];

        return $collection[$bucket] ?? $collection;
    }
}
