<?php
/**
 * Created by PhpStorm.
 * User: afrisoft
 * Date: 2/20/20
 * Time: 10:29 AM
 */

namespace Tests\Feature;


use App\Thread;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;

class ThreadApiTest extends TestCase
{
    use DatabaseMigrations;

    public function test_user_can_see_all_api_threads(){
       $thread = create(Thread::class);
       $response = $this->get('/api/threads');
          $response->assertStatus(200)
            ->assertJsonStructure(['success','message','data'])
            ->assertSee('Threads fetched successfully')
            ->assertSee($thread->title);
    }
    public function test_a_user_cannot_see_title_if_no_threads(){
        $thread = make(Thread::class);
        $response = $this->get('/api/threads');
        $response->assertStatus(200)
            ->assertDontSee($thread->title);
    }
    public function test_unauthenticated_user_cannot_create_thread(){
        $this->withExceptionHandling();
        $this->post("/api/threads")
            ->assertRedirect('login');
    }
    public function test_authenticated_user_can_create_thread(){
        $this->signIn();
        $thread = make(Thread::class);
        $response = $this->signIn()->post("/api/threads",$thread->toArray());
           $response->assertSee($thread->title)
            ->assertSee($thread->body);
    }

}