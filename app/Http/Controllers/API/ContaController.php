<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Conta;
use App\Http\Resources\ContaResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ContaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $Contas = Conta::all();
        return response([ 'data' => ContaResource::collection($Contas), 'message' => 'Retrieved successfully'], 200);
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
            'nome' => 'required|max:255',
            'senha' => 'required|min:10',
            'email' => 'required|email',
            'nascimento' => 'required|date'
        ]);

        if ($validator->fails()) {
            return response(['error' => $validator->errors(), 'message' => 'Validation Error']);
        }

    
        $Conta = Conta::create($data);
        return response(['data' => new ContaResource($Conta), 'message' => 'Created successfully'], 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Conta  $Conta
     * @return \Illuminate\Http\Response
     */
    public function show(Conta $Conta)
    {
        return response(['data' => new ContaResource($Conta), 'message' => 'Retrieved successfully'], 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Conta  $Conta
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Conta $Conta)
    {
        $Conta->update($request->all());

        return response(['data' => new ContaResource($Conta), 'message' => 'Update successfully'], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Conta  $Conta
     * @return \Illuminate\Http\Response
     */
    public function destroy(Conta $Conta)
    {
        $Conta->delete();

        return response(['message' => 'Deleted']);
    }
}