<?php

namespace App\Http\Repositories\Admin;

use App\Http\Interfaces\Admin\AdminNewsInterface;
use App\Http\Traits\ApiResponseTrait;
use App\Http\Traits\News\NewsTrait;
use App\Models\News;

class AdminNewsRepository implements AdminNewsInterface
{
    private $newsModel;
    use ApiResponseTrait, NewsTrait;
    public function __construct(News $news)
    {
        $this->newsModel = $news;
    }

    public function index()
    {
        $news = $this->getNews();
        return $this->apiResponse(200, 'News Data', null, $news);
    }

    public function create($request, $service)
    {
        $imageName = $service->uploadImage($request->image);
        $news = $this->newsModel::create([
            'title' => $request->title,
            'image' => $imageName,
            'date' => $request->date,
            'description' => $request->description
        ]);
        return $this->apiResponse(200, 'News Was Created', null, $news);
    }

    public function delete($request, $service)
    {
        $news = $this->findNews($request->id);
        $service->deleteImageInLocal($news->image);
        $news->delete();
        return $this->apiResponse(200, 'News Was Deleted');
    }

    public function update($request, $service)
    {
        $news = $this->findNews($request->id);
        $image = $service->checkImage($request->image, $news);
        $news->update([
            'title' => $request->title,
            'image' => $image,
            'date' => $request->date,
            'description' => $request->description ?? $news->description
        ]);
        return $this->apiResponse(200, 'News Was Updated');
    }
}
