<?php

namespace App\Http\Controllers;

use App\Models\Agama;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Http\Requests\StoreAgamaRequest;
use App\Http\Requests\UpdateAgamaRequest;

class Agama24Controller extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index24()
    {
        if (Auth::check()) {
            if (Auth::user()->role == 'Admin') {
                $data = Agama::all();
                return view('admin.agama.index', compact('data'));
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
                return view('admin.agama.add');
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
     * @param  \App\Http\Requests\StoreAgamaRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store24(Request $request)
    {
        if (Auth::check()) {
            if (Auth::user()->role == 'Admin') {
                
                $request->validate([
                    'name' => 'required|string|max:150',
                ]);
        
                $agama = new Agama();
                $agama->name = $request->name;
                $agama->save();
        
                return redirect('/agama24')->with('success_message', 'Agama berhasil ditambahkan!');

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
     * @param  \App\Models\Agama  $agama
     * @return \Illuminate\Http\Response
     */
    public function show24(Agama $agama)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Agama  $agama
     * @return \Illuminate\Http\Response
     */
    public function edit24($id)
    {
        if (Auth::check()) {
            if (Auth::user()->role == 'Admin') {
                $agama = Agama::where('id', '=', $id)->first();
                return view('admin.agama.edit', compact('agama'));
            } else {
                return redirect('/');
            }
        } else {
            return redirect('/')->with('error_message', 'Silakan login kembali!');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateAgamaRequest  $request
     * @param  \App\Models\Agama  $agama
     * @return \Illuminate\Http\Response
     */
    public function update24(Request $request)
    {
        if (Auth::check()) {
            if (Auth::user()->role == 'Admin') {
                
                $request->validate([
                    'name' => 'required|string|max:150',
                ]);
        
                $agama = Agama::find($request->id);
                $agama->name = $request->name;
                $agama->save();
        
                return redirect('/agama24')->with('success_message', 'Agama berhasil diubah!');

            } else {
                return redirect('/');
            }
        } else {
            return redirect('/')->with('error_message', 'Silakan login kembali!');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Agama  $agama
     * @return \Illuminate\Http\Response
     */
    public function destroy24(Request $request)
    {
        if (Auth::check()) {
            if (Auth::user()->role == 'Admin') {
                
                $agama = Agama::find($request->id);
                $agama->delete();
        
                return redirect('/agama24')->with('success_message', 'Agama berhasil dihapus!');

            } else {
                return redirect('/');
            }
        } else {
            return redirect('/')->with('error_message', 'Silakan login kembali!');
        }
    }
}
