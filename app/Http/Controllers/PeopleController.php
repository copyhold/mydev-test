<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Models\People;
use App\Http\Resources\PeopleResource;

class PeopleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

      $collection = People
        ::skinColor($request->input('skin_color'))
        ->eyeColor($request->input('eye_color'))
        ->name($request->input('name'))
        ->gender($request->input('gender'));
      if ($request->input('heights') && count($request->input('heights')) == 2) {
        $collection = $collection->inHeight($request->input('heights')[0], $request->input('heights')[1]);
      }
      $data = $collection->orderBy('name')->paginate(20);
      return PeopleResource::collection($data);
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

    public function getStats()
    {
      $mass_height = DB::table('peoples')
        ->selectRaw('max(height) as maxheight, min(height) as minheight, max(mass) as maxmass, min(mass) as minmass')
        ->get();
      $eyes = DB::table('peoples')
        ->selectRaw('group_concat(distinct eye_color) as eyes')
        ->pluck('eyes');
      $skins = DB::table('peoples')
        ->selectRaw('group_concat(distinct skin_color) as skins')
        ->pluck('skins');
      $genders = DB::table('peoples')
        ->selectRaw('group_concat(distinct gender) as genders')
        ->pluck('genders');
      return array_merge((array)$mass_height->first(), [
        'eyes'    => array_values(array_unique(array_map(function($color) { return trim($color); }, explode(',', $eyes[0])))),
        'skins'   => array_values(array_unique(array_map(function($color) { return trim($color); }, explode(',', $skins[0])))),
        'genders' => array_values(array_unique(array_map(function($gende) { return trim($gende); }, explode(',', $genders[0])))),
      ]);
    }
}
