<?php

namespace Tests\Feature;

use App\Reply;
use App\Thread;
use App\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ParticipateInForumTest extends TestCase
{
    use DatabaseMigrations;
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_unauthenticated_user_may_not_add_reply(){
        $thread = create(Thread::class);
        $this->withExceptionHandling()->post($thread->path().'/replies',[])->assertRedirect('login');
    }
   public function test_an_authenticated_user_can_participate_in_threads(){
        $this->withExceptionHandling()->signIn();
        $thread = create(Thread::class);
        $reply = make(Reply::class,['thread_id'=>$thread->id]);
       $this->post($thread->path().'/replies',$reply->toArray());
        $this->get($thread->path())
            ->assertSee($reply->body);

   }
   public function test_a_reply_requires_body(){
    $this->withExceptionHandling()->signIn();

       $thread = create(Thread::class);

       $this->validate_required(Reply::class,$thread->path().'/replies',['thread_id'=>$thread->id,'body'=>null])
           ->assertSessionHasErrors('body');
   }
}
