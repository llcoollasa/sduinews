<?php

namespace App\Http\Controllers;

use App\Events\NewsCreated;
use App\Http\Requests\StoreNewsRequest;
use App\Http\Requests\UpdateNewsRequest;
use App\Interfaces\NewsRepositoryInterface;
use App\Models\News;

class NewsController extends Controller
{
    private NewsRepositoryInterface $newsRepository;

    public function __construct(NewsRepositoryInterface $newsRepository)
    {
        $this->middleware('auth')->except(['index', 'show']);
        $this->newsRepository = $newsRepository;
    }

    public function index()
    {
        $news = $this->newsRepository->getAllNewsByUser();

        return view('news.index', compact('news'));
    }

    public function create()
    {
        return view('news.create');
    }

    public function store(StoreNewsRequest $request)
    {
        $newsItem = $request->only([
            'title',
            'content'
        ]);
        $news = $this->newsRepository->createNews($newsItem);

        NewsCreated::dispatch($news);

        return redirect()->route('news.index')
            ->with('success', 'News created successfully.');
    }

    public function show(News $news)
    {
        return view('news.show', compact('news'));
    }

    public function edit(News $news)
    {
        return view('news.edit', compact('news'));
    }

    public function update(UpdateNewsRequest $request, News $news)
    {
        $updatedNews = $request->only([
            'title',
            'content'
        ]);

        $updated = $this->newsRepository->updateNews($news->id, $updatedNews);

        return redirect()->route('news.index')
            ->with('success', 'News updated successfully');
    }

    public function destroy(News $news)
    {
        $this->newsRepository->deleteNews($news->id);

        return redirect()->route('news.index')
            ->with('success', 'News deleted successfully');
    }
}
