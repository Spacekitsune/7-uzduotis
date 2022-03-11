<?php

namespace App\Http\Controllers;

use App\Models\Type;
use App\Models\Article;
use App\Http\Requests\StoreTypeRequest;
use App\Http\Requests\UpdateTypeRequest;
use Illuminate\Http\Request;

class TypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $type = Type::all();
        $article = Article::all();
        return view("type.index", ['types' => $type, 'articles' => $article]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("create.index");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreTypeRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $type = new Type;
        $type->title = $request->type_title;
        $type->description = $request->type_description;

        $type->save();
        return redirect()->route('type.index');
    }

    public function storeAjax(Request $request)
    {
        $type = new Type;
        $type->title = $request->type_title;
        $type->description = $request->type_description;

        $type->save();

        $type_array = array(
            'successMessage' => "type stored succesfuly",
            'typeId' => $type->id,
            'typeTitle' => $type->title,
            'typeDescription' => $type->description,
            'typeHasArticles' => count($type->typeArticles),
        );

        $json_response = response()->json($type_array);

        return $json_response;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Type  $type
     * @return \Illuminate\Http\Response
     */
    public function show(Type $type)
    {
        //
    }

    public function showAjax(Type $type)
    {

        $type_array = array(
            'successMessage' => "Type retrieved succesfuly",
            'typeId' => $type->id,
            'typeTitle' => $type->title,
            'typeDescription' => $type->description,
        );

        $json_response = response()->json($type_array);

        return $json_response;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Type  $type
     * @return \Illuminate\Http\Response
     */
    public function edit(Type $type)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateTypeRequest  $request
     * @param  \App\Models\Type  $type
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateTypeRequest $request, Type $type)
    {
        //
    }

    public function updateAjax(Request $request, Type $type)
    {
        $type->title = $request->type_title;
        $type->description = $request->type_description;

        $type->save();

        $type_array = array(
            'successMessage' => "Type updated succesfuly",
            'typeId' => $type->id,
            'typeTitle' => $type->title,
            'typeDescription' => $type->description,
        );

        $json_response = response()->json($type_array);

        return $json_response;
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Type  $type
     * @return \Illuminate\Http\Response
     */
    public function destroy(Type $type)
    {
        //
    }

    public function destroyAjax(Type $type)
    {


        if (count($type->typeArticles) > 0) {
            $response_array = array(
                'errorMessage' => $type->title . " type can't be deleted, bacouse it has ".count($type->typeArticles)." articles");
        } else {

            $type->delete();
            $response_array = array(
                'successMessage' => $type->title . " type deleted successfuly"
            );
        }
        $json_response = response()->json($response_array);

        return $json_response;
    }
}
