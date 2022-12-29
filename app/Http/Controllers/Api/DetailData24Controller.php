<?php

namespace App\Http\Controllers\Api;

use DateTime;
use App\Models\DetailData;
use App\Http\Resources\ApiFormat;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class DetailData24Controller extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index24($id)
    {
        $this->id = $id;
        $detail = DB::table('detail_data')
                ->join('agamas', function ($join) {
                    $join->on('detail_data.id_agama', '=', 'agamas.id')
                        ->where('detail_data.id_user', '=', $this->id);
                    })
                ->select('detail_data.*', DB::raw('agamas.name AS agama'))
                ->get()->first();
        if ($detail == null) {
            $status = 0;
        } else {
            $status = 1;
        }
        $data = [
            'detail' => $detail,
            'status' => $status
        ];
        return new ApiFormat(true, 'Detail Data', $data);
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
    public function store24(Request $request)
    {
        $detail = new DetailData();
        $detail->id_user = $request->id_user;
        $detail->address = $request->address;
        $detail->birth_place = $request->birthplace;
        $detail->birth_date = $request->birthdate;
        $detail->id_agama = $request->agama;
        $detail->foto_ktp = $request->foto_ktp;
        $detail->age = $request->age;
        $detail->save();
        
        return new ApiFormat(true, 'Detail data berhasil ditambahkan!', $detail);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show24($id)
    {
        $detail = DetailData::where('id', '=', $id)->first();
        if (!$detail) {
            return new ApiFormat(false, 'Detail data tidak ditemukan!', null);
        }
        return new ApiFormat(true, 'Berhasil mendapatkan detail data!', $detail);
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
    public function update24(Request $request)
    {
        $detail = DetailData::find($request->id);
        if (!$detail) {
            return new ApiFormat(false, 'Detail data tidak ditemukan!', null);
        }
        
        $detail->id_user = $request->id_user;
        $detail->address = $request->address;
        $detail->birth_place = $request->birthplace;
        $detail->birth_date = $request->birthdate;
        $detail->id_agama = $request->agama;
        $detail->age = $request->age;
        if ($request->foto_ktp != null) {
            $detail->foto_ktp = $request->foto_ktp;
        }
        $detail->save();
        
        return new ApiFormat(true, 'Detail data berhasil diubah!', $detail);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy24($id)
    {
        $detail = DetailData::find($id);
        if (!$detail) {
            return new ApiFormat(false, 'Detail data tidak ditemukan!', null);
        }
        $detail->delete();
        return new ApiFormat(true, 'Detail data berhasil dihapus!', $detail);
    }
}
