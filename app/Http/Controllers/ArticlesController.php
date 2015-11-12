<?php

namespace App\Http\Controllers;
use App\Article;
use App\Http\Requests;
use App\Http\Requests\ArticleRequest;
use Illuminate\Http\Request;
use Illuminate\HttpResponse;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Laracasts\Flash\Flash;


class ArticlesController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth',['except' => ['index','show']]);
    }
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
     *@param Article $article
     *@return response
     * */
    public function show(Article $article)
    {
        //oude methode
        //$article = Article::findOrFail($id);

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


        Auth::user()->articles()->create($request->all());

        //flash()->overlay('yout article has been succesfully created', 'Good job!!');

        flash('You are now Logged in');

        return redirect('articles')->with('flash_message');
    }

     /*
     * edit an article
     *
     *@param Article $article
     *@return response
     * */
    public function edit(Article $article)
    {

        //$article = Article::findOrFail($id); oude methode

        return view('articles.edit',compact('article'));
    }
    /*
    * update an article
    *
    *@param Article $article
    *@return response
    * */
    public function update(Article $article, ArticleRequest $request)
    {
        //$article = Article::findOrFail($id); oude methode

        $article->update($request->all());

        return redirect('articles');
    }
}


