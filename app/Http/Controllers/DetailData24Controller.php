<?php

namespace App\Http\Controllers;

use DateTime;
use App\Models\Agama;
use App\Models\DetailData;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use App\Http\Requests\StoreDetailDataRequest;
use App\Http\Requests\UpdateDetailDataRequest;

class DetailData24Controller extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index24()
    {
        if (Auth::check()) {
            if (Auth::user()->is_active == 1) {
                $detail = DB::table('detail_data')
                    ->join('agamas', function ($join) {
                        $join->on('detail_data.id_agama', '=', 'agamas.id')
                            ->where('detail_data.id_user', '=', Auth::user()->id);
                    })
                    ->select('detail_data.*', DB::raw('agamas.name AS agama'))
                    ->get()->first();
                if ($detail == null) {
                    $status = 0;
                } else {
                    $status = 1;
                }
                return view('user.detail.index', compact('status', 'detail'));
            } else {
                return redirect('/')->with('error_message', 'Fitur tidak dapat diakses, pengguna belum aktif!');
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
            if (Auth::user()->is_active == 1) {
                $agama = Agama::all();
                return view('user.detail.add', compact('agama'));
            } else {
                return redirect('/')->with('error_message', 'Fitur tidak dapat diakses, pengguna belum aktif!');
            }
        } else {
            return redirect('/')->with('error_message', 'Silakan login kembali!');
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreDetailDataRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store24(Request $request)
    {
        if (Auth::check()) {
            if (Auth::user()->is_active == 1) {
                $request->validate([
                    'birthplace' => 'required|string|max:150',
                    'birthdate' => 'required',
                    'agama' => 'required',
                    'address' => 'required',
                    'foto-ktp' => 'required'
                ]);

                //count age
                $dob = new DateTime("$request->birthdate");
                $now = new DateTime('today');
                $age = $dob->diff($now)->y;

                //foto ktp
                $image = $request->file('foto-ktp');
                $folder = 'uploads/ktp';
                $extension = $image->getClientOriginalExtension();
                $image_newname = Str::uuid().".".$extension;
                $image->move($folder, $image_newname);

                $detail = new DetailData();
                $detail->id_user = Auth::user()->id;
                $detail->address = $request->address;
                $detail->birth_place = $request->birthplace;
                $detail->birth_date = $request->birthdate;
                $detail->id_agama = $request->agama;
                $detail->foto_ktp = $image_newname;
                $detail->age = $age;
                $detail->save();

                return redirect('/detail24')->with('success_message', 'Detail data berhasil ditambahkan!');
            } else {
                return redirect('/')->with('error_message', 'Fitur tidak dapat diakses, pengguna belum aktif!');
            }
        } else {
            return redirect('/')->with('error_message', 'Silakan login kembali!');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\DetailData  $detailData
     * @return \Illuminate\Http\Response
     */
    public function show24(DetailData $detailData)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\DetailData  $detailData
     * @return \Illuminate\Http\Response
     */
    public function edit24($id)
    {
        if (Auth::check()) {
            if (Auth::user()->is_active == 1) {
                $agama = Agama::all();
                $detail = DetailData::where('id', '=', $id)->first();
                return view('user.detail.edit', compact('agama', 'detail'));
            } else {
                return redirect('/')->with('error_message', 'Fitur tidak dapat diakses, pengguna belum aktif!');
            }
        } else {
            return redirect('/')->with('error_message', 'Silakan login kembali!');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateDetailDataRequest  $request
     * @param  \App\Models\DetailData  $detailData
     * @return \Illuminate\Http\Response
     */
    public function update24(Request $request)
    {
        if (Auth::check()) {
            if (Auth::user()->is_active == 1) {
                $request->validate([
                    'birthplace' => 'required|string|max:150',
                    'birthdate' => 'required',
                    'agama' => 'required',
                    'address' => 'required'
                ]);

                //count age
                $dob = new DateTime("$request->birthdate");
                $now = new DateTime('today');
                $age = $dob->diff($now)->y;

                //foto ktp
                $image = $request->file('foto-ktp');
                if ($image != null) {
                    $folder = 'uploads/ktp';
                    $extension = $image->getClientOriginalExtension();
                    $image_newname = Str::uuid().".".$extension;
                    $image->move($folder, $image_newname);
                }

                $detail = DetailData::find($request->id);
                $detail->id_user = Auth::user()->id;
                $detail->address = $request->address;
                $detail->birth_place = $request->birthplace;
                $detail->birth_date = $request->birthdate;
                $detail->id_agama = $request->agama;
                $detail->age = $age;
                if ($image != null) {
                    $detail->foto_ktp = $image_newname;
                }
                $detail->save();

                return redirect('/detail24')->with('success_message', 'Detail data berhasil diubah!');
            } else {
                return redirect('/')->with('error_message', 'Fitur tidak dapat diakses, pengguna belum aktif!');
            }
        } else {
            return redirect('/')->with('error_message', 'Silakan login kembali!');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\DetailData  $detailData
     * @return \Illuminate\Http\Response
     */
    public function destroy24(Request $request)
    {
        if (Auth::check()) {
            if (Auth::user()->is_active == 1) {
                
                $detail = DetailData::find($request->id2);
                $detail->delete();
        
                return redirect('/detail24')->with('success_message', 'Detail data berhasil dihapus!');

            } else {
                return redirect('/');
            }
        } else {
            return redirect('/');
        }
    }
}
