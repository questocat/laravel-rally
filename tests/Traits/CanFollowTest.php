<?php

/*
 * This file is part of questocat/laravel-rally package.
 *
 * (c) emanci <zhengchaopu@gmail.com>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace Tests\Traits;

use Tests\Stubs\User;
use Tests\TestCase;

class CanFollowTest extends TestCase
{
    public function test_user_can_follow_by_id()
    {
        $user1 = User::find(1);
        $user2 = User::find(2);

        $user1->follow($user2->id);

        $this->assertCount(1, $user1->following);
        $this->assertCount(1, $user2->followers);
    }

    public function test_user_can_follow_other_user()
    {
        $user = User::find(1);
        $otherUser = User::find(2);

        $user->follow($otherUser);

        $this->assertCount(1, $user->following);
        $this->assertCount(1, $otherUser->followers);
    }

    public function test_user_can_follow_multiple_users()
    {
        $user1 = User::find(1);
        $user2 = User::find(2);
        $user3 = User::find(3);

        $user1->follow([$user2->id, $user3->id]);

        $this->assertCount(2, $user1->following);
        $this->assertCount(1, $user2->followers);
        $this->assertCount(1, $user3->followers);
    }

    public function test_unfollow_user()
    {
        $user1 = User::find(1);
        $user2 = User::find(2);

        $user1->follow($user2->id);
        $this->assertCount(1, $user2->followers);

        $user1->unfollow($user2->id);
        $this->assertCount(0, $user1->following);
    }

    public function test_is_following()
    {
        $user1 = User::find(1);
        $user2 = User::find(2);

        $user1->follow($user2->id);

        $this->assertTrue($user1->isFollowing($user2->id));
    }

    public function test_toggle_follow()
    {
        $user1 = User::find(1);
        $user2 = User::find(2);

        $user1->toggleFollow($user2->id);
        $this->assertCount(1, $user1->following);

        $user1->toggleFollow($user2->id);
        $this->assertCount(0, $user2->followers);
    }
}
