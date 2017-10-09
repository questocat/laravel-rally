<?php

namespace Emanci\Rally\Traits;

use Emanci\Rally\Models\Follower;
use Illuminate\Database\Eloquent\Model;

trait CanFollow
{
    /**
     * Follow a followable entity.
     *
     * @param \Illuminate\Database\Eloquent\Model $followable
     *
     * @return \Emanci\Rally\Models\Follower|false
     */
    public function follow(Model $followable)
    {
        if ($this->isFollowing($followable)) {
            return false;
        }

        $followable = (new Follower())->fillFollowable($followable);

        return $this->following()->save($followable);
    }

    /**
     * Unfollow a followable entity.
     *
     * @param \Illuminate\Database\Eloquent\Model $followable
     *
     * @return bool|null
     */
    public function unfollow(Model $followable)
    {
        return Follower::following($followable)->followedBy($this)->delete();
    }

    /**
     * Check if entity is following given entity.
     *
     * @param \Illuminate\Database\Eloquent\Model $followable
     *
     * @return bool
     */
    public function isFollowing(Model $followable)
    {
        return $this->findFollowing($followable)->exists();
    }

    /**
     * Returns a following entity.
     *
     * @param \Illuminate\Database\Eloquent\Model $followable
     *
     * @return \Emanci\Rally\Models\Follower
     */
    public function findFollowing(Model $followable)
    {
        return $this->following()->following($followable);
    }

    /**
     * Return entity followings.
     *
     * @return \Illuminate\Database\Eloquent\Relations\MorphMany
     */
    public function following()
    {
        return $this->morphMany(Follower::class, 'follower');
    }
}
