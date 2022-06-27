<?php

namespace Tests\Unit;

use App\Models\News;
use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class UserTest extends TestCase
{
    use DatabaseMigrations, RefreshDatabase;

    public function testUserCanHaveManyNews()
    {
        $user = User::factory()->create();
        $news = News::factory()->count(2)->create(['user_id' => $user->id]);

        $this->assertEquals($user->news[0]->id, $news[0]->id);
        $this->assertEquals($user->news[1]->id, $news[1]->id);
    }
}
