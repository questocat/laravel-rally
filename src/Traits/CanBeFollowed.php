<?php

namespace Emanci\Rally\Traits;

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
        return $this->morphToMany(config('rally.follower_model'), config('rally.followable_prefix'), config('rally.followers_table'), null, config('rally.follower_prefix').'_id');
    }
}
