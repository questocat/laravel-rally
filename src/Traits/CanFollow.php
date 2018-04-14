<?php

/*
 * This file is part of questocat/laravel-rally package.
 *
 * (c) questocat <zhengchaopu@gmail.com>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace Questocat\Rally\Traits;

trait CanFollow
{
    /**
     * Follow a followable entity.
     *
     * @param int|array|\Illuminate\Database\Eloquent\Model $followable
     * @param string                                        $className
     *
     * @return array
     */
    public function follow($followable, $className = __CLASS__)
    {
        return $this->following($className)->sync($followable, false);
    }

    /**
     * Unfollow a followable entity.
     *
     * @param int|array|\Illuminate\Database\Eloquent\Model $followable
     * @param string                                        $className
     *
     * @return bool|null
     */
    public function unfollow($followable, $className = __CLASS__)
    {
        return $this->following($className)->detach($followable);
    }

    /**
     * Check if entity is following given entity.
     *
     * @param int|\Illuminate\Database\Eloquent\Model $followable
     * @param string                                  $className
     *
     * @return bool
     */
    public function isFollowing($followable, $className = __CLASS__)
    {
        return $this->following($className)->get()->contains($followable);
    }

    /**
     * Toggle follow a followable or followables.
     *
     * @param int|array|\Illuminate\Database\Eloquent\Model $followable
     * @param string                                        $className
     *
     * @return array
     */
    public function toggleFollow($followable, $className = __CLASS__)
    {
        return $this->following($className)->toggle($followable);
    }

    /**
     * Return entity following.
     *
     * @param string $className
     *
     * @return \Illuminate\Database\Eloquent\Relations\MorphToMany
     */
    public function following($className = __CLASS__)
    {
        return $this->morphedByMany($className, config('rally.followable_prefix'), config('rally.followers_table'), config('rally.follower_prefix').'_id', config('rally.followable_prefix').'_id')->withTimestamps();
    }
}
