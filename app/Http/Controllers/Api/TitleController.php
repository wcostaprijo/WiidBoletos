<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class TitleController extends Controller
{
    /**
     * Display a listing of the titles.
     *
     * @return \Illuminate\Http\ResponseJson
     */
    public function index()
    {
        return response()->json(auth('api')->user()->titles, 200);
    }

    /**
     * Display a listing of the titles from specifc payer.
     *
     * @return \Illuminate\Http\ResponseJson
     */
    public function listByPayer($id)
    {
        if($payer = \App\Models\Payer::find($id)){
            return response()->json($payer->titles, 200);
        }
        return response()->json(['error' => 'Pagador não encontrado.'], 404);
    }

    /**
     * Store a newly created title in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\ResponseJson
     */
    public function store(\App\Http\Requests\Title\StoreRequest $request)
    {
        return response()->json(auth('api')->user()->titles()->create($request->validated()), 201);
    }

    /**
     * Update the specified title in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\ResponseJson
     */
    public function update(\App\Http\Requests\Title\UpdateRequest $request, $id)
    {
        if($title = auth('api')->user()->titles()->find($id)){
            return response()->json($title->update($request->validated()), 200);
        }
        return response()->json(['error' => 'Boleto não encontrado.'], 404);
    }

    /**
     * Remove the specified title from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\ResponseJson
     */
    public function destroy($id)
    {
        if($title = auth('api')->user()->titles()->find($id)){
            return response()->json($title->delete(), 200);
        }
        return response()->json(['error' => 'Boleto não encontrado.'], 404);
    }
}
