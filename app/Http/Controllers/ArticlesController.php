<?php

namespace App\Http\Controllers;
use App\Article;
use App\Http\Requests;
use App\Http\Requests\ArticleRequest;
use Illuminate\Http\Request;
use Illuminate\HttpResponse;
use App\Http\Controllers\Controller;



class ArticlesController extends Controller
{
    /*
     *  show all articles
     *
     * @return response
     * */
    public function index()
    {
        $articles = Article::latest('published_at')->published()->get();

        return view('articles.index',compact('articles'));
    }

    /*
     * show a single article
     *
     *@param integer $id
     *@return response
     * */
    public function show($id)
    {
        $article = Article::findOrFail($id);

        // testing
        //dd($article->created_at->addDays(8)->diffforHumans());
        //dd($article->published_at);

        return view('articles.show',compact('article'));
    }

    /*
     * show the page of creating a new article
     *
     *
     *@return response
     * */
    public function create()
    {
        return view('articles.create');
    }

    /*
     * Save an article
     *
     *
     *@return response
     * */
    public function store(ArticleRequest $request)
    {

        Article::create($request->all());

        return redirect('articles');
    }
    public function edit($id)
    {

        $article = Article::findOrFail($id);

        return view('articles.edit',compact('article'));
    }

    public function update($id, ArticleRequest $request)
    {
        $article = Article::findOrFail($id);

        $article->update($request->all());

        return redirect('articles');
    }
}


