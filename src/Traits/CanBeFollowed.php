<?php

namespace Emanci\Rally\Traits;

use App\User;

trait CanBeFollowed
{
    /**
     * Check if entity is followed by given entity.
     *
     * @param int|\Illuminate\Database\Eloquent\Model $follower
     *
     * @return bool
     */
    public function isFollowedBy($follower)
    {
        return $this->followers->contains($follower);
    }

    /**
     * Returns the entity that followed this entity.
     *
     * @return \Illuminate\Database\Eloquent\Relations\MorphToMany
     */
    public function followers()
    {
        return $this->morphToMany(User::class, 'followable', config('rally.followers_table'), 'followable_id', 'follower_id');
    }
}
