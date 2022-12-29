<?php

namespace App\Http\Controllers\Api;

use App\Models\Agama;
use App\Http\Resources\ApiFormat;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class Agama24Controller extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index24()
    {
        $data = Agama::all();
        return new ApiFormat(true, 'Daftar Agama', $data);
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
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:150',
        ]);
        if ($validator->fails()) {
            return new ApiFormat(false, 'Validasi gagal', $validator->errors()->all());
        }

        $agama = Agama::create([
            'name' => $request->name
        ]);
        if (!$agama) {
            return new ApiFormat(true, 'Agama gagal ditambahkan!', $agama);
        }
        return new ApiFormat(true, 'Agama berhasil ditambahkan!', $agama);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show24($id)
    {
        $agama = Agama::find($id);
        if (!$agama) {
            return new ApiFormat(false, 'Agama tidak ditemukan!', null);
        }
        return new ApiFormat(true, 'Berhasil mendapatkan data agama!', $agama);
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
        $agama = Agama::find($request->id);
        if (!$agama) {
            return new ApiFormat(false, 'Agama tidak ditemukan!', null);
        }

        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:150',
        ]);
        if ($validator->fails()) {
            return new ApiFormat(false, 'Validasi gagal', $validator->errors()->all());
        }

        $agama->update([
            'name' => $request->name
        ]);

        return new ApiFormat(true, 'Agama berhasil diubah!', $agama);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy24(Request $request)
    {
        $agama = Agama::find($request->id);
        if (!$agama) {
            return new ApiFormat(false, 'Agama tidak ditemukan!', null);
        }
        $agama->delete();

        return new ApiFormat(true, 'Agama berhasil dihapus!', $agama);
    }
}
