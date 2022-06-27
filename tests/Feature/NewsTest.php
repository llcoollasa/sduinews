<?php

namespace Tests\Feature;

use App\Events\NewsCreated;
use App\Models\News;
use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Support\Facades\Event;
use Tests\TestCase;

class NewsTest extends TestCase
{
    use DatabaseMigrations;

    public function testUserCanReadAllNews()
    {
        $news = News::factory()->create();

        $response = $this->get('/news');

        $response->assertSee($news->title);
    }

    public function testUserCanReadSingleNewsItem()
    {
        $newsList = News::factory()->count(3)->create();
        $selectedNews = $newsList[2];

        $response = $this->get('/news/'. $selectedNews->id);

        $response->assertSee($selectedNews->title);
    }

    public function testUserCanCreateNews()
    {
        $user = User::factory()->create();

        $newsList = News::factory()->make(['user_id' => $user->id]);

        /** @var mixed $user */
        $this->actingAs($user);

        $response = $this->post('/news', $newsList->toArray());
        $response->assertRedirect(route('news.index'));
        $this->assertDatabaseHas('news', [
            'title' => $newsList->title,
        ]);
    }

    public function testUserCanUpdateNewsItem()
    {
        $user = User::factory()->create();
        $news = News::factory()->create(['user_id' => $user->id]);

        /** @var mixed $user */
        $this->actingAs($user);

        $response = $this->put('/news/'. $news->id, [
            'title' => 'New Title',
            "content" => "New Content",
        ]);

        $response->assertRedirect(route('news.index'));
        $this->assertDatabaseHas('news', [
            'title' => 'New Title',
        ]);
    }

    public function testUserCanDeleteNewsItem()
    {
        $user = User::factory()->create();
        $news = News::factory()->create(['user_id' => $user->id]);

        /** @var mixed $user */
        $this->actingAs($user);

        $this->delete('/news/'. $news->id);

        $this->assertSoftDeleted('news', ['id' => $news->id]);
    }

    public function testUserWillNotSeeDeletedNews()
    {
        $user = User::factory()->create();
        $newsList = News::factory()->count(2)->create(['user_id' => $user->id]);

        /** @var mixed $user */
        $this->actingAs($user);

        $this->delete('/news/'. $newsList[0]->id);

        $response = $this->get('/news');

        $response->assertSee($newsList[1]->title);
        $response->assertDontSee($newsList[0]->title);
    }
}
