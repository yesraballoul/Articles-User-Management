<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Http\Requests\StoreArticleRequest;
use App\Http\Requests\UpdateArticleRequest;
use Illuminate\Support\Arr;

class ArticleController extends Controller
{

    /**
     * Create the controller instance.
     */
    public function __construct()
    {
        $this->authorizeResource(Article::class, 'article');
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $articlesTableColumns = [
            "title",
            "body",
            "author",
            "created_at",
            "updated_at",
        ];

        if (auth()->user()->can("update articles")) {
            array_push($articlesTableColumns, "edit");
        }
        if (auth()->user()->can("delete articles")) {
            array_push($articlesTableColumns, "delete");
        }

        $articlesTableColumnsDTFormat = Arr::map($articlesTableColumns, function ($value, $key) {
            if ($value === 'edit' || $value === 'delete' || $value === 'author') {
                return ["data" => $value, "orderable" => false];
            }
            return ["data" => $value];
        });

        return response()->view('articles.index', compact("articlesTableColumnsDTFormat"));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return response()->view("articles.create");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreArticleRequest $request)
    {
        $article = Article::create([
            "title" => $request->title,
            "body"=>$request->body,
            "user_id" => auth()->user()->id
    ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Article $article)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Article $article)
    {
        return response()->view('articles.edit');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateArticleRequest $request, Article $article)
    {
        $article->fill([
            'title' => $request->title,
            'body' =>$request->body
        ])->save();
        return redirect()->route("articles.index")->with("status", "Article updated successfully!!");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Article $article)
    {
        //
    }
}
