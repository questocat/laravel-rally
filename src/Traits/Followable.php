<?php

namespace Emanci\Rally\Traits;

trait Followable
{
    use CanFollow,CanBeFollowed;

    /**
     * Check if it is mutual follow.
     *
     *@param \Illuminate\Database\Eloquent\Model $followable
     *
     * @return bool
     */
    public function isMutualFollow(Model $followable)
    {
        return $this->isFollowing($followable) && $this->isFollowedBy($followable);
    }
}
