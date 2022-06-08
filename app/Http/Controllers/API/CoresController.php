<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Cores;
use App\Http\Resources\CoresResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CoresController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $Coress = Cores::all();
        return response([ 'data' => CoresResource::collection($Coress), 'message' => 'Retrieved successfully'], 200);
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
            'corCabelo' => 'required|',
            'corOlho' => 'required|',
            'corCorpo' => 'required|',
            // 'weight' => 'required|integer|min:10',
            // 'height' => 'required|numeric'
        ]);

        if ($validator->fails()) {
            return response(['error' => $validator->errors(), 'message' => 'Validation Error']);
        }

        

        $Cores = Cores::create($data);
        return response(['data' => new CoresResource($Cores), 'message' => 'Created successfully'], 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Cores  $Cores
     * @return \Illuminate\Http\Response
     */
    public function show(Cores $Cores)
    {
        return response(['data' => new CoresResource($Cores), 'message' => 'Retrieved successfully'], 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Cores  $Cores
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Cores $Cores)
    {
        $Cores->update($request->all());

        return response(['data' => new CoresResource($Cores), 'message' => 'Update successfully'], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Cores  $Cores
     * @return \Illuminate\Http\Response
     */
    public function destroy(Cores $Cores)
    {
        $Cores->delete();

        return response(['message' => 'Deleted']);
    }
}