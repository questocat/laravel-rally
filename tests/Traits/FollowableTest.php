<?php

namespace Tests\Traits;

use Tests\Stubs\User;
use Tests\TestCase;

class FollowableTest extends TestCase
{
    public function test_is_mutual_follow()
    {
        $user1 = User::find(1);
        $user2 = User::find(2);

        $user1->follow($user2->id);
        $user2->follow($user1->id);

        $this->assertTrue($user1->isMutualFollow($user2));
        $this->assertTrue($user2->isMutualFollow($user1));
    }
}
