<?php

namespace Tests\Unit;

use App\Models\News;
use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class NewsTest extends TestCase
{
    use DatabaseMigrations, RefreshDatabase;

    public function testNewsBelongsToAUser()
    {
        $users = User::factory()->count(2)->create();
        $userId = $users[0]->id;
        $news = News::factory()->count(2)->create(['user_id' => $userId]);

        $this->assertEquals($news[0]->user->id, $userId);
        $this->assertEquals($news[1]->user->id, $userId);
    }
}
