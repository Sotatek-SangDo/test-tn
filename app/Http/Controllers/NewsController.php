<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\News;

class NewsController extends Controller
{
    public function __construct()
    {

    }

    public function allNews()
    {
        $news = News::all();
        return view('layouts.news', ['news' => $news]);
    }

    public function show($id)
    {
        $new = News::findOrFail($id);
        return view('layouts.shows', ['new' => $new]);
    }
}
