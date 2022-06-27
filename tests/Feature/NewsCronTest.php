<?php

namespace Tests\Feature;

use App\Models\News;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;

class NewsCronTest extends TestCase
{
    use DatabaseMigrations;

    public function testCronWillDeleteNewsAfter14Days()
    {
        $date = now()->subDays(15);

        $latestNews = News::factory()->create();
        $oldNews = News::factory()->create([
            'created_at' => $date
        ]);

        $this->assertDatabaseCount('news', 2);

        $this->artisan('news:cron')->assertExitCode(0);
        $this->assertDatabaseHas('news', [
            'id' => $latestNews->id,
            'deleted_at' => null
        ]);
        $this->assertSoftDeleted('news', [ 'id' => $oldNews->id ]);
    }
}
