<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Payer;

class PayerController extends Controller
{
    /**
     * Display a listing of the payers.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response()->json(auth('api')->user()->payers,200);
    }

    /**
     * Store a newly created payer in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\ResponseJson
     */
    public function store(\App\Http\Requests\Payer\StoreRequest $request)
    {
        return response()->json(auth('api')->user()->payers()->create($request->validated()), 201);
    }

    /**
     * Update the specified payer in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\ResponseJson
     */
    public function update(\App\Http\Requests\Payer\UpdateRequest $request, $id)
    {
        if($payer = auth('api')->user()->payers()->find($id)){
            return response()->json($payer->update($request->validated()), 200);
        }
        return response()->json(['error' => 'Pagador não encontrado.'], 404);
    }

    /**
     * Remove the specified payer from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\ResponseJson
     */
    public function destroy($id)
    {
        if($payer = auth('api')->user()->payers()->find($id)){
            return response()->json($payer->delete(), 200);
        }
        return response()->json(['error' => 'Pagador não encontrado.'], 404);
    }
}
