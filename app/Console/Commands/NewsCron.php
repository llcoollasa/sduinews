<?php

namespace App\Console\Commands;

use App\Interfaces\NewsRepositoryInterface;
use App\Models\News;
use App\Repositories\NewsRepository;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;

class NewsCron extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'news:cron';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Delete 14 days old news';

    private NewsRepositoryInterface $newsRepository;

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct(NewsRepositoryInterface $newsRepository)
    {
        $this->newsRepository = $newsRepository;
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $this->newsRepository->deleteOldNews();
        return 0;
    }
}
