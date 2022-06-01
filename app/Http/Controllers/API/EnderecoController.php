<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Endereco;
use App\Http\Resources\EnderecoResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class EnderecoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $Enderecos = Endereco::all();
        return response([ 'data' => EnderecoResource::collection($Enderecos), 'message' => 'Retrieved successfully'], 200);
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
            'endereco' => 'required|max:255',
            'cep' => 'required|numeric',
            'numCasa' => 'required|numeric',
            'bairro' => 'required|',
            'cidade' => 'required|',
            'estado' => 'required|',
        ]);

        if ($validator->fails()) {
            return response(['error' => $validator->errors(), 'message' => 'Validation Error']);
        }

        $data['result'] = $data['weight'] / pow($data['height'], 2);

        $Endereco = Endereco::create($data);
        return response(['data' => new EnderecoResource($Endereco), 'message' => 'Created successfully'], 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Endereco  $Endereco
     * @return \Illuminate\Http\Response
     */
    public function show(Endereco $Endereco)
    {
        return response(['data' => new EnderecoResource($Endereco), 'message' => 'Retrieved successfully'], 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Endereco  $Endereco
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Endereco $Endereco)
    {
        $Endereco->update($request->all());

        return response(['data' => new EnderecoResource($Endereco), 'message' => 'Update successfully'], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Endereco  $Endereco
     * @return \Illuminate\Http\Response
     */
    public function destroy(Endereco $Endereco)
    {
        $Endereco->delete();

        return response(['message' => 'Deleted']);
    }
}