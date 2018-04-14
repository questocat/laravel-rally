<?php

/*
 * This file is part of questocat/laravel-rally package.
 *
 * (c) questocat <zhengchaopu@gmail.com>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace Tests\Traits;

use Tests\Stubs\User;
use Tests\TestCase;

class CanBeFollowedTest extends TestCase
{
    public function test_is_followed_by()
    {
        $user1 = User::find(1);
        $user2 = User::find(2);

        $user1->follow($user2->id);

        $this->assertTrue($user2->isFollowedBy($user1->id));
    }
}
