<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreatePageRequest;
use App\Http\Resources\PageResource;
use App\Page;
use DateTime;

class PageController extends Controller
{

    function __construct()
    {
        date_default_timezone_set('Asia/Kolkata');
    }

    private function dated() {
        return now()->format('Y-m-d');
    }

    public function index() {
        if(!auth()->user()->pages()->whereDated($this->dated())->exists()) {
            $page = new Page();
            $page->title = '';
            $page->content = '';
            $page->dated = $this->dated();
            auth()->user()->pages()->save($page);
        }
        $pages = auth()->user()->pages;
        return response()->json([
            'message' => 'Page fetch successful!',
            'pages' => PageResource::collection(auth()->user()->pages()->orderBy('dated', 'desc')->get())
        ]);
    }

    public function save(CreatePageRequest $request) {
        $page = auth()->user()->pages()->where('dated', $this->dated())->first();
        if($page) {
            $page->update($request->validated());
        } else {
            $page = $request->validated();
            $page['dated'] = $this->dated();
            $page = auth()->user()->pages()->save(new Page($page));
        }
        return response()->json([
            'message' => 'Page saved successfully!',
            'page' => new PageResource($page)
        ]);
    }
}
