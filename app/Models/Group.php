<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name'
    ];

    protected static function boot()
    {
        parent::boot();

        static::deleting(function($group) {
            $relationMethods = ['users'];

            foreach ($relationMethods as $relationMethod) {
                if ($group->$relationMethod()->count() > 0) {
                    return false;
                }
            }
        });
    }

    public function users()
    {
        return $this->hasMany('App\Models\User');
    }
}
