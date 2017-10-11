<?php

namespace Emanci\Rally\Traits;

use Illuminate\Database\Eloquent\Model;

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
        $followable = $this->parseFollowable($followable);

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
        $followable = $this->parseFollowable($followable);

        return $this->following($className)->detach($followable);
    }

    /**
     * Check if entity is following given entity.
     *
     * @param int|\Illuminate\Database\Eloquent\Model $followable
     *
     * @return bool
     */
    public function isFollowing($followable)
    {
        return $this->following->contains($followable);
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
        $followable = $this->parseFollowable($followable);

        return $this->following($className)->toggle($followable);
    }

    /**
     * Return entity followings.
     *
     * @param string $className
     *
     * @return \Illuminate\Database\Eloquent\Relations\MorphToMany
     */
    public function following($className = __CLASS__)
    {
        return $this->morphedByMany($className, config('rally.followable_prefix'), config('rally.followers_table'), config('rally.followable_prefix').'_id', config('rally.follower_prefix').'_id')->withTimestamps();
    }

    /**
     * @param int|array|\Illuminate\Database\Eloquent\Model $followable
     *
     * @return array|\Illuminate\Database\Eloquent\Model
     */
    protected function parseFollowable($followable)
    {
        if ($followable instanceof Model) {
            return $followable;
        }

        return (array) $followable;
    }
}
