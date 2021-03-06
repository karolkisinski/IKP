<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Pet;
use App\Http\Requests\PetFormRequest;
use Inertia\Inertia;

class PetsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Inertia::render('Pets',[
            'pets' => auth()->user()->pets,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Request\PetFormRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PetFormRequest $request)
    {
        $data = $request->only(['name', 'user_id', 'age', 'race']);
        auth()->user()->pets()->create([
            'name' => $data['name'],
            'race' => $data['race'],
            'age' => $data['age'],

            ]);
        return back();
  }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(PetFormRequest $request, Pet $pet)
    {
        $pet->name = $request->input('name');
        $pet->race = $request->input('race');
        $pet->age = $request->input('age');

        $pet->save();

        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Pet $pet
     * @return \Illuminate\Http\Response
     */
    public function destroy(Pet $pet)
    {
        $pet->delete();
        return back();
    }
}
