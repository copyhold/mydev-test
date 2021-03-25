<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\People;
use App\Http\Resources\PeopleResource;

class PeopleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      return PeopleResource::collection(People::paginate(15));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
      $character = People::findOrFail($id);
      $character->load('species', 'films');
      return new PeopleResource($character);
    }
}
