<?php

namespace App\Repositories;

use App\Interfaces\NewsRepositoryInterface;
use App\Models\News;
use App\Models\User;
use DateTime;
use Exception;
use Illuminate\Support\Facades\Auth;

class NewsRepository implements NewsRepositoryInterface
{
    public function x() {
        return News::first();
    }

    public function getAllNewsByUser()
    {
        return Auth::user()->news;
    }

    public function getAllNews()
    {
        return News::all();
    }

    public function deleteNews($newsId)
    {
        return News::destroy($newsId);
    }

    public function createNews(array $orderDetails)
    {
        return News::create($orderDetails);
    }

    public function updateNews($newsId, array $newDetails)
    {
        News::where('id', $newsId)->update($newDetails);

        return News::where('id', $newsId)->first();
    }

    public function deleteOldNews()
    {
        return News::where('created_at', "<", now()->subDays(14))->delete();
    }
}
