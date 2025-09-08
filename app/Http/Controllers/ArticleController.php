<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;
use App\Http\Requests\ArticleRequest;

class ArticleController extends Controller
{

    public function index()
    {
        $articles = Article::all();
        return view('maintenance.article.list_article',[
            'articles' => $articles
        ]);
    }
    public function create()
    {
        //
    }

    public function store(ArticleRequest $request)
    {
        $article = Article::create($request->validated());
        return to_route('article.index')->with('success','Frequence créer avec succès');
    }

    public function edit(Article $article)
    {
        return view('maintenance.article.list_article',[
            'articles' => Article::all(),
            'editArticle' => $article,
        ]);
    }

    public function update(ArticleRequest $request, Article $article)
    {
        $article->update($request->validated());
        return to_route('article.index')->with('success','Modifié avec succès');
    }
    public function destroy(Article $article)
    {
        $article->delete();
        return to_route('article.index')->with('success','Ligne supprimée');
    }
}
