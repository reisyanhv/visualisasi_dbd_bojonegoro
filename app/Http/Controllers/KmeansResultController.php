<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Year;
use App\Models\KmeansResult;
use App\Models\Subdistrict;
use App\Models\Criteria;
use Illuminate\Support\Facades\DB;

class KmeansResultController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function cluster2018()
    {
        $id = 1;
        $items = Criteria::where('year_id', $id)->get();
        foreach ($items as $item) {
            $item['tahun'] = $id;
            $item['kecamatan'] = $item->subdistrict_id;
            $item['nama_kecamatan'] = Subdistrict::where('id', $item->subdistrict_id)->first()['name'];
            $item['cluster'] = KmeansResult::where(['year_id' => $id, 'subdistrict_id' => $item->subdistrict_id])->first()['risk'];
        }
        return json_encode($items);
        // return view('data', compact('criterias'));
    }

    public function cluster2019()
    {
        $id = 2;
        $items = Criteria::where('year_id', $id)->get();
        foreach ($items as $item) {
            $item['tahun'] = $id;
            $item['kecamatan'] = $item->subdistrict_id;
            $item['nama_kecamatan'] = Subdistrict::where('id', $item->subdistrict_id)->first()['name'];
            $item['cluster'] = KmeansResult::where(['year_id' => $id, 'subdistrict_id' => $item->subdistrict_id])->first()['risk'];
        }
        return json_encode($items);
        // return view('data', compact('criterias'));
    }

    public function cluster2020()
    {
        $id = 3;
        $items = Criteria::where('year_id', $id)->get();
        foreach ($items as $item) {
            $item['tahun'] = $id;
            $item['kecamatan'] = $item->subdistrict_id;
            $item['nama_kecamatan'] = Subdistrict::where('id', $item->subdistrict_id)->first()['name'];
            $item['cluster'] = KmeansResult::where(['year_id' => $id, 'subdistrict_id' => $item->subdistrict_id])->first()['risk'];
        }
        return json_encode($items);
        // return view('data', compact('criterias'));
    }

    public function cluster2021()
    {
        $id = 4;
        $items = Criteria::where('year_id', $id)->get();
        foreach ($items as $item) {
            $item['tahun'] = $id;
            $item['kecamatan'] = $item->subdistrict_id;
            $item['nama_kecamatan'] = Subdistrict::where('id', $item->subdistrict_id)->first()['name'];
            $item['cluster'] = KmeansResult::where(['year_id' => $id, 'subdistrict_id' => $item->subdistrict_id])->first()['risk'];
        }
        return json_encode($items);
        // return view('data', compact('criterias'));
    }
    // public function grafik()
    // {
    //     $risk_2018 = DB::table('kmeans_results')
    //         ->select(DB::raw("COUNT(risk) as risk"))
    //         ->where('year_id', 1)
    //         ->groupBy('risk')
    //         ->get()->toArray();
    //     $risk_2018 = array_column($risk_2018, 'risk');
    //     array_unshift($risk_2018, "2018");

    //     $risk_2019 = DB::table('kmeans_results')
    //         ->select(DB::raw("COUNT(risk) as risk"))
    //         ->where('year_id', 2)
    //         ->groupBy('risk')
    //         ->get()->toArray();
    //     $risk_2019 = array_column($risk_2019, 'risk');
    //     array_unshift($risk_2019, "2019");

    //     $risk_2020 = DB::table('kmeans_results')
    //         ->select(DB::raw("COUNT(risk) as risk"))
    //         ->where('year_id', 3)
    //         ->groupBy('risk')
    //         ->get()->toArray();
    //     $risk_2020 = array_column($risk_2020, 'risk');
    //     array_unshift($risk_2020, "2020");

    //     $risk_2021 = DB::table('kmeans_results')
    //         ->select(DB::raw("COUNT(risk) as risk"))
    //         ->where('year_id', 4)
    //         ->groupBy('risk')
    //         ->get()->toArray();
    //     $risk_2021 = array_column($risk_2021, 'risk');
    //     array_unshift($risk_2021, "2021");

    //     $result[] = ['Tahun', 'Rendah', 'Sedang', 'Tinggi'];
    //     array_push($result, $risk_2018, $risk_2019, $risk_2020, $risk_2021);

    //     return view('grafik', compact('result'));
    // }

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
