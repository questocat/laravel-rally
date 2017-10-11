<?php

/*
 * This file is part of laravel-rally package.
 *
 * (c) emanci <zhengchaopu@gmail.com>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

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
        return $this->morphToMany(config('rally.follower_model'), config('rally.followable_prefix'), config('rally.followers_table'), config('rally.followable_prefix').'_id', config('rally.follower_prefix').'_id');
    }
}
