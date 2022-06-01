<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Parametros;
use App\Http\Resources\ParametrosResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ParametrosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $Parametross = Parametros::all();
        return response([ 'data' => ParametrosResource::collection($Parametross), 'message' => 'Retrieved successfully'], 200);
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
            
            'cabeca' => 'required|integer',
            'orelha'=> 'required|integer',
            'olho'=> 'required|integer',
            'nariz'=> 'required|integer',
            'boca'=> 'required|integer',
            'queixo'=> 'required|integer',
            'braco'=> 'required|integer',
            'tronco'=> 'required|integer',
            'perna'=> 'required|integer',
            'pe'=> 'required|integer'
            
        ]);

        if ($validator->fails()) {
            return response(['error' => $validator->errors(), 'message' => 'Validation Error']);
        }

        $data['result'] = $data['weight'] / pow($data['height'], 2);

        $Parametros = Parametros::create($data);
        return response(['data' => new ParametrosResource($Parametros), 'message' => 'Created successfully'], 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Parametros  $Parametros
     * @return \Illuminate\Http\Response
     */
    public function show(Parametros $Parametros)
    {
        return response(['data' => new ParametrosResource($Parametros), 'message' => 'Retrieved successfully'], 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Parametros  $Parametros
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Parametros $Parametros)
    {
        $Parametros->update($request->all());

        return response(['data' => new ParametrosResource($Parametros), 'message' => 'Update successfully'], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Parametros  $Parametros
     * @return \Illuminate\Http\Response
     */
    public function destroy(Parametros $Parametros)
    {
        $Parametros->delete();

        return response(['message' => 'Deleted']);
    }
}