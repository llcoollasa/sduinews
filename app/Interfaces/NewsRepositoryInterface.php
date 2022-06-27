<?php

namespace App\Interfaces;

interface NewsRepositoryInterface
{
    public function getAllNewsByUser();
    public function getAllNews();
    public function deleteNews($orderId);
    public function createNews(array $orderDetails);
    public function updateNews($orderId, array $newDetails);
    public function deleteOldNews();
}
