<?php

namespace Tests\Feature;

use App\Reply;
use App\Thread;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ReadThreadTest extends TestCase
{
    use DatabaseMigrations;
    public function setUp(): void
    {
        parent::setUp(); // TODO: Change the autogenerated stub
        $this->thread = create(Thread::class);
    }

    /**
     * A basic test example.
     *
     * @return void
     */
    public function test_a_user_can_browse_all_threads()
    {
        $response = $this ->get('/threads');
        $response->assertSee($this->thread->title);


    }
    public function test_a_user_can_view_a_thread(){
        $response = $this ->get($this->thread->path());
        $response->assertSee($this->thread->title);
    }
    public function test_a_user_can_read_replies_associated_with_a_thread(){
        $reply = create(Reply::class,['thread_id'=>$this->thread->id]);
        $response = $this->get($this->thread->path());
        $response->assertSee($reply->body);
    }
    public function test_an_authenticated_user_can_create_thread(){
        $this->actingAs(create('App\User'));
        $thread = make(Thread::class);
        $response = $this->post("/threads",$thread->toArray());
        $this->get($response->headers->get('Location'))
            ->assertSee($thread->title)
            ->assertSee($thread->body);
    }
    public function test_unauthenticated_user_may_not_create_thread(){
        $thread = make(Thread::class);
        $this->withExceptionHandling();
            $this->get('/threads/create')
                ->assertRedirect('login');

            $this->post("/threads",$thread->toArray())
            ->assertRedirect('login');
    }
    public function test_user_can_see_create_thread_form(){
        $this->signIn();
        $this->get('/threads/create')->assertStatus(200);
    }
    public  function test_a_thread_can_make_a_string_path(){
        $this->assertEquals('/threads/'.$this->thread->channel->slug.'/'.$this->thread->id,$this->thread->path());
    }
}
