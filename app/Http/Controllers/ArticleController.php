<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Type;
use App\Http\Requests\StoreArticleRequest;
use App\Http\Requests\UpdateArticleRequest;
use Illuminate\Http\Request;

class ArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $article = Article::all();
        return view("article.index", ['articles' => $article]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreArticleRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreArticleRequest $request)
    {
        //
    }

    public function storeAjax(Request $request)
    {
        //Kuriamas naujas objektas iš Request reikšmių, siuntimui į db
        $article = new Article;
        $article->title = $request->article_title;
        $article->type_id = $request->article_typeId;
        $article->description = $request->article_description;
        
        $article->save();

        //Kuriamas naujas asociatyvinis masyvas su $article objekto reikšmėmis + success žinutė
        $article_array = array(
            'successMessage' => "article stored succesfuly",
            'articleId' => $article->id,
            'articleTitle' => $article->title,
            'articleTypeId' => $article->type_id,
            'articleDescription' => $article->description,            
        );

        //Asociatyvinis masyvas paverčiamas į json
        $json_response = response()->json($article_array);

        // gražinama sukurta json reikšmė
        return $json_response;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function show(Article $article)
    {
        //
    }

    public function showAjax(Article $article) {

        $article_array = array(
            'successMessage' => "Article retrieved succesfuly",
            'articleId' => $article->id,
            'articleTitle' => $article->title,
            'articleTypeId' => $article->type_id,
            'articleDescription' => $article->description,
        );

        $json_response =response()->json($article_array); 

        return $json_response;
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function edit(Article $article)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateArticleRequest  $request
     * @param  \App\Models\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateArticleRequest $request, Article $article)
    {
        //
    }

    public function updateAjax(Request $request, Article $article)
    {
        $article->title = $request->article_title;
        $article->type_id = $request->article_typeId;
        $article->description = $request->article_description;
    
        $article->save();

        $article_array = array(
            'successMessage' => "Article updated succesfuly",
            'articleId' => $article->id,
            'articleTitle' => $article->title,
            'articleTypeId' => $article->type_id,
            'articleDescription' => $article->description,
        );

        $json_response =response()->json($article_array); 

        return $json_response;
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function destroy(Article $article)
    {
        $article->delete();
        return redirect()->route("article.index");
    }

    public function destroyAjax(Article $article)
    {
        $article->delete();

        $success_array = array(
            'successMessage' => $article->title. " article deleted successfuly"
        );

        $json_response =response()->json($success_array);

        return $json_response;
    }
}
