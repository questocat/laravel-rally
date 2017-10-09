<?php

namespace Emanci\Rally\Traits;

use Emanci\Rally\Models\Follower;
use Illuminate\Database\Eloquent\Model;

trait CanBeFollowed
{
    /**
     * Check if entity is followed by given entity.
     *
     * @param \Illuminate\Database\Eloquent\Model $follower
     *
     * @return bool
     */
    public function isFollowedBy(Model $follower)
    {
        return $this->findFollowedBy($follower)->exists();
    }

    /**
     * Returns a followed entity by given entity.
     *
     * @param \Illuminate\Database\Eloquent\Model $followable
     *
     * @return \Emanci\Rally\Models\Follower
     */
    public function findFollowedBy(Model $follower)
    {
        return $this->followers()->followedBy($follower);
    }

    /**
     * Returns the entity that followed this entity.
     *
     * @return \Illuminate\Database\Eloquent\Relations\MorphMany
     */
    public function followers()
    {
        return $this->morphMany(Follower::class, 'followable');
    }
}
