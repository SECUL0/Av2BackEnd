<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Personagem;
use App\Http\Resources\PersonagemResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PersonagemController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $Personagems = Personagem::all();
        return response([ 'data' => PersonagemResource::collection($Personagems), 'message' => 'Retrieved successfully'], 200);
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
            'nick' => 'required|min:2',
            'classe' => 'required|',
            'sexo' => 'required|',
            // 'weight' => 'required|integer|min:10',
            // 'height' => 'required|numeric'
        ]);

        if ($validator->fails()) {
            return response(['error' => $validator->errors(), 'message' => 'Validation Error']);
        }

       

        $Personagem = Personagem::create($data);
        return response(['data' => new PersonagemResource($Personagem), 'message' => 'Created successfully'], 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Personagem  $Personagem
     * @return \Illuminate\Http\Response
     */
    public function show(Personagem $Personagem)
    {
        return response(['data' => new PersonagemResource($Personagem), 'message' => 'Retrieved successfully'], 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Personagem  $Personagem
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Personagem $Personagem)
    {
        $Personagem->update($request->all());

        return response(['data' => new PersonagemResource($Personagem), 'message' => 'Update successfully'], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Personagem  $Personagem
     * @return \Illuminate\Http\Response
     */
    public function destroy(Personagem $Personagem)
    {
        $Personagem->delete();

        return response(['message' => 'Deleted']);
    }
}