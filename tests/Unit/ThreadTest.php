<?php

namespace Tests\Unit;

use App\Thread;
use App\User;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;

class ThreadTest extends TestCase
{
    use DatabaseMigrations;
    protected $thread;
    public function setUp():void {
        parent::setUp();
        $this->thread = create(Thread::class);
    }
    /**
     * A basic unit test example.
     *
     * @return void
     */

    public function test_a_thread_has_many_replies()
    {
        $this->assertInstanceOf(Collection::class,$this->thread->replies);
    }
    public function test_a_thread_has_creator(){
        $this->assertInstanceOf(User::class,$this->thread->creator);
    }
    public function test_a_thread_can_add_reply(){
        $this->thread->add_reply([
            'user_id'=>1,
            'body'=>'Foobar',
        ]);
        $this->assertCount(1,$this->thread->replies);
    }
    public function test_thread_belongs_to_a_channel(){
       $this->assertInstanceOf('App\Channel',$this->thread->channel);
    }
}
