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
use App\Tag;

class ArticlesController extends Controller
{
    /*
     * create a new article controller instance
     *
     * */
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
        $tags = Tag::lists('name','id');

        return view('articles.create',compact('tags'));
    }

    /*
     *  Save an article
     *
     *  @param  ArticleRequest $request
     *  @return response
     * */
    public function store(ArticleRequest $request)
    {
        $this->createArticle($request);

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
        $tags = Tag::lists('name','id'); // tijdelijk

        return view('articles.edit',compact('article','tags'));
    }
    /*
    * update an article
    *
    *@param ArticleRequest $request
    *@param Article $article
    *@return response
    * */
    public function update(ArticleRequest $request, Article $article)
    {
        $article->update($request->all());

        $this->syncTags($article, $request->input('tag_list'));

        return redirect('articles');
    }

    /**
     * sync up the lists of tags in the database
     * @param Article $article
     * @param array   $tags
     */
    private function syncTags(Article $article, array $tags)
    {
        $article->tags()->sync($tags);
    }

    /*
     * save a new article
     * $param   ArticleRequest $request
     * @return  mixed
     * */
    private function createArticle(ArticleRequest $request)
    {
        $article = Auth::user()->articles()->create($request->all());

        $this->syncTags($article, $request->input('tag_list'));

        return $article;
    }

}


