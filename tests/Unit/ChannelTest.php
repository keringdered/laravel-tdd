<?php

namespace Tests\Feature;

use App\Channel;
use Illuminate\Database\Eloquent\Collection;
use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class ChannelTest extends TestCase
{
    use DatabaseMigrations;
    protected $channel;
    public function setUp(): void
    {
        parent::setUp();
        $this->channel = create(Channel::class);
    }

    /**
     * @test
     *
     * @return void
     */
    public function test_channel_has_many_threads()
    {
        $this->assertInstanceOf(Collection::class, $this->channel->threads);
    }
}
