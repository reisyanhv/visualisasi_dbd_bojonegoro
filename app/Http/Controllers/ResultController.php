<?php

namespace App\Http\Controllers;

use App\Models\Result;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ResultController extends Controller
{
    public function grafik()
    {
        $risk_2018 = DB::table('results')
             ->select(DB::raw("COUNT(risk) as risk"))
             ->where('year_id', 1)
             ->groupBy('risk')
             ->get()->toArray();
        $risk_2018 = array_column($risk_2018, 'risk');
        array_unshift($risk_2018,"2018");

        $risk_2019 = DB::table('results')
             ->select(DB::raw("COUNT(risk) as risk"))
             ->where('year_id', 2)
             ->groupBy('risk')
             ->get()->toArray();
        $risk_2019 = array_column($risk_2019, 'risk');
        array_unshift($risk_2019,"2019");

        $risk_2020 = DB::table('results')
             ->select(DB::raw("COUNT(risk) as risk"))
             ->where('year_id', 3)
             ->groupBy('risk')
             ->get()->toArray();
        $risk_2020 = array_column($risk_2020, 'risk');
        array_unshift($risk_2020,"2020");

        $risk_2021 = DB::table('results')
             ->select(DB::raw("COUNT(risk) as risk"))
             ->where('year_id', 4)
             ->groupBy('risk')
             ->get()->toArray();
        $risk_2021 = array_column($risk_2021, 'risk');
        array_unshift($risk_2021,"2021");

        $result[] = ['Tahun','Rendah','Sedang','Tinggi'];
        array_push($result,$risk_2018,$risk_2019,$risk_2020,$risk_2021);

        return view('grafik', compact('result'));
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
