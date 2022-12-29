<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use App\Http\Resources\ApiFormat;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class Auth24Controller extends Controller
{
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
    public function store24(Request $request)
    {
        //register process
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:150',
            'email' => 'required|string|max:150|email|unique:users',
            'password' => 'required|string|min:8'
        ]);
        if ($validator->fails()) {
            return new ApiFormat(false, 'Validasi gagal', $validator->errors()->all());
        }

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password)
        ]);
        if (!$user) {
            return new ApiFormat(true, 'Registrasi gagal!', $user);
        }
        return new ApiFormat(true, 'Registrasi berhasil!', $user);
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

    public function updatePassword24(Request $request) {
        $user = User::find($request->id);
        $user->password = Hash::make($request->newpass);
        $user->save();
        return new ApiFormat(true, 'Password berhasil diubah!', $user);
    }

    public function updateImage24(Request $request) {
        $user = User::find($request->id);
        if (!$user) {
            return new ApiFormat(false, 'Pengguna tidak ditemukan!', null);
        }

        $user->photo = $request->image_newname;
        $user->save();
        return new ApiFormat(true, 'Foto profil berhasil diubah!', $user);
    }
}
