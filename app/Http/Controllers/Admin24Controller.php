<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\DetailData;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class Admin24Controller extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index24()
    {
        //show user detail
        if (Auth::check()) {
            if (Auth::user()->role == 'Admin') {
                $data = DB::table('detail_data')
                        ->join('users', function ($join) {
                            $join->on('detail_data.id_user', '=', 'users.id');
                            })
                        ->select(
                            DB::raw('detail_data.id AS id'), 
                            DB::raw('users.name AS name'), 
                            DB::raw('users.email AS email'), 
                            DB::raw('users.is_active AS status'), 
                            DB::raw('users.photo AS photo'),
                            DB::raw('detail_data.birth_place AS birthplace'), 
                            DB::raw('detail_data.age AS age'))
                        ->get();
                return view('admin.detaildata', compact('data'));
            } else {
                return redirect('/');
            }
        } else {
            return redirect('/')->with('error_message', 'Silakan login kembali!');
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create24()
    {
        if (Auth::check()) {
            if (Auth::user()->role == 'Admin') {
                $user = User::where('role', '=', 'User')->get();
                return view('admin.approval', compact('user'));
            } else {
                return redirect('/');
            }
        } else {
            return redirect('/')->with('error_message', 'Silakan login kembali!');
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store24(Request $request)
    {
        //change user approval
        if (Auth::check()) {
            if (Auth::user()->role == 'Admin') {
                $status = User::where('id', '=', $request->id)->value('is_active');;
                $user = User::find($request->id);
                if ($status == 1) {
                    $user->is_active = 0;
                    $user->save();
                } else {
                    $user->is_active = 1;
                    $user->save();
                }

                return redirect('/approval24')->with('success_message', 'Status user berhasil diubah!');
            } else {
                return redirect('/');
            }
        } else {
            return redirect('/')->with('error_message', 'Silakan login kembali!');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show24($id)
    {
        //show detail user
        if (Auth::check()) {
            if (Auth::user()->role == 'Admin') {
                $data = DB::table('detail_data')
                        ->leftJoin('users', 'detail_data.id_user', '=', 'users.id')
                        ->leftJoin('agamas', 'detail_data.id_agama', '=', 'agamas.id')
                        ->where('detail_data.id', '=', $id)
                        ->select(
                            DB::raw('detail_data.id AS id'), 
                            DB::raw('users.name AS name'), 
                            DB::raw('users.email AS email'), 
                            DB::raw('users.is_active AS status'), 
                            DB::raw('users.photo AS photo'),
                            DB::raw('detail_data.address AS address'),
                            DB::raw('detail_data.birth_place AS birthplace'), 
                            DB::raw('detail_data.birth_date AS birthdate'), 
                            DB::raw('agamas.name AS agama'),
                            DB::raw('detail_data.foto_ktp AS ktp'),
                            DB::raw('detail_data.age AS age'))
                        ->get()->first();
                return view('admin.datadetails', compact('data'));
            } else {
                return redirect('/');
            }
        } else {
            return redirect('/')->with('error_message', 'Silakan login kembali!');
        }
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
