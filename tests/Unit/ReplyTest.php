<?php

namespace Tests\Unit;

use App\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;

class ReplyTest extends TestCase
{
    use DatabaseMigrations;
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function test_it_has_a_owner()
    {
        $reply  = create('App\Reply');
        $this->assertInstanceOf(User::class,$reply->owner);
    }
}
