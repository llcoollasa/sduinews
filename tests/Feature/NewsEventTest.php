<?php

namespace Tests\Feature;

use App\Events\NewsCreated;
use App\Listeners\SendNewsCreatedNotification;
use App\Models\News;
use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Log;
use Tests\TestCase;

class NewsEventTest extends TestCase
{
    use DatabaseMigrations;

    public function testEventListenerWasTriggered()
    {
        Event::fake([
            NewsCreated::class
        ]);

        $user = User::factory()->create();
        $news = News::factory()->make(['user_id' => $user->id ]);

        /** @var mixed $user */
        $this->actingAs($user);
        $this->post('/news', $news->toArray());

        Event::assertDispatched(NewsCreated::class);
    }

    /*
     * TODO: Complet the test after building the event listener
     */
    public function todo_EventListenerExecuteWhenNewsCreated()
    {
        $news = News::factory()->make([
            'title' => 'Initial title',
        ]);

        (new SendNewsCreatedNotification())->handle(
            new NewsCreated($news)
        );

        // I have added the log message in event listener for the moment
        // we can assert the listener output after implement the proper functionality
        // ex: sends a slack notification
    }
}
