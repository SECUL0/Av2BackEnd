<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Personagem;
use App\Http\Resources\ImcResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ImcController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $imcs = Imc::all();
        return response([ 'data' => ImcResource::collection($imcs), 'message' => 'Retrieved successfully'], 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->all();

        $validator = Validator::make($data, [
            'name' => 'required|max:255',
            'weight' => 'required|integer|min:10',
            'height' => 'required|numeric'
        ]);

        if ($validator->fails()) {
            return response(['error' => $validator->errors(), 'message' => 'Validation Error']);
        }

        $data['result'] = $data['weight'] / pow($data['height'], 2);

        $imc = Imc::create($data);
        return response(['data' => new ImcResource($imc), 'message' => 'Created successfully'], 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Imc  $imc
     * @return \Illuminate\Http\Response
     */
    public function show(Imc $imc)
    {
        return response(['data' => new ImcResource($imc), 'message' => 'Retrieved successfully'], 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Imc  $imc
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Imc $imc)
    {
        $imc->update($request->all());

        return response(['data' => new ImcResource($imc), 'message' => 'Update successfully'], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Imc  $imc
     * @return \Illuminate\Http\Response
     */
    public function destroy(Imc $imc)
    {
        $imc->delete();

        return response(['message' => 'Deleted']);
    }
}