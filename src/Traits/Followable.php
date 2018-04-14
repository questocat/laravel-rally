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

trait Followable
{
    use CanFollow, CanBeFollowed;

    /**
     * Check if it is mutual follow.
     *
     *@param int|\Illuminate\Database\Eloquent\Model $followable
     *
     * @return bool
     */
    public function isMutualFollow($followable)
    {
        return $this->isFollowing($followable) && $this->isFollowedBy($followable);
    }
}
