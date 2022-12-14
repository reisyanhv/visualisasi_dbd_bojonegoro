<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PredictionCriteria;
use App\Models\Year;
use App\Models\PredictionResult;
use App\Models\Subdistrict;

class PredictionCriteriaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $criterias = PredictionCriteria::where('year_id',5)->get();
        foreach ($criterias as $item) {
            $item['year'] = Year::where('id', $item->year_id)->first();
            $item['subdistrict'] = Subdistrict::where('id', $item->subdistrict_id)->first();
        }
        return view('data', compact('criterias'));
    }

    public function cluster_prediksi()
    {
        $id=5;
        $items = PredictionCriteria::where('year_id',$id)->get();
        foreach ($items as $item) {
            $item['tahun'] = $id;
            $item['kecamatan'] = $item->subdistrict_id;
            $item['nama_kecamatan'] = Subdistrict::where('id', $item->subdistrict_id)->first()['name'];
            $item['cluster'] = PredictionResult::where(['year_id'=>$id,'subdistrict_id'=>$item->subdistrict_id])->first()['risk'];
        }
        return json_encode($items);
        // return view('data', compact('criterias'));
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
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
