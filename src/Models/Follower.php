<?php

namespace Emanci\Rally\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class Follower extends Model
{
    protected $fillable = ['followable_id', 'followable_type'];

    /**
     * Follower construct.
     *
     * @param array $attributes
     */
    public function __construct(array $attributes = [])
    {
        $this->table = config('rally.followers_table');
        parent::__construct($attributes);
    }

    /**
     * Returns the entity that followed this entity.
     *
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function follower()
    {
        return $this->morphTo();
    }

    /**
     * Returns the entity that followed this entity.
     *
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function followable()
    {
        return $this->morphTo();
    }

     /**
      * @param \Illuminate\Database\Eloquent\Model  $followable
      *
      * @return $this
      */
     public function fillFollowable(Model $followable)
     {
         return $this->fill([
             'followable_id' => $followable->getKey(),
             'followable_type' => $followable->getMorphClass(),
         ]);
     }

    /**
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @param \Illuminate\Database\Eloquent\Model   $follower
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeFollowedBy(Builder $query, Model $follower)
    {
        return $query
            ->where('follower_id',   $follower->getKey())
            ->where('follower_type', $follower->getMorphClass());
    }

    /**
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @param \Illuminate\Database\Eloquent\Model   $followable
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeFollowing(Builder $query, Model $followable)
    {
        return $query
            ->where('followable_id',   $followable->getKey())
            ->where('followable_type', $followable->getMorphClass());
    }
}
