<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;

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

    public function store(Request $request)
    {
        //
    }

    public function edit(Article $article)
    {
        return view('maintenance.gestion.list_depot',[
            'articles' => Article::all(),
            'editArticle' => $article,
        ]);
    }

    public function update(Request $request, string $id)
    {

    }
    public function destroy(string $id)
    {

    }
}
