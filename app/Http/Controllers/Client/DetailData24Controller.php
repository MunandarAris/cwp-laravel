<?php

namespace App\Http\Controllers\Client;

use DateTime;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use GuzzleHttp\Client;

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
                $id = Auth::user()->id;
                $client = new Client;
                $base_uri = "http://localhost/PRAK_BACKEND/laravel-uas/public/api";
                $response = $client->request('GET', "{$base_uri}/detail24/{$id}");
                $body = $response->getBody();
                    
                $result = json_decode($body, true)['data'];
                $status =  $result['status'];
                $detail =  $result['detail'];
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
                $client = new Client;
                $base_uri = "http://localhost/PRAK_BACKEND/laravel-uas/public/api";
                $response = $client->request('GET', "{$base_uri}/agama24");
                $body = $response->getBody();
                
                $result = json_decode($body, true);
                $agama =  $result['data'];
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
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store24(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'birthplace' => 'required|string|max:150',
            'birthdate' => 'required',
            'agama' => 'required',
            'address' => 'required',
            'foto_ktp' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ]);
        if ($validator->fails()) {
            return redirect('/detail24')->with('success_message', 'Detail data gagal ditambahkan!');
        }

        //count age
        $dob = new DateTime("$request->birthdate");
        $now = new DateTime('today');
        $age = $dob->diff($now)->y;

        //foto ktp
        $image = $request->file('foto_ktp');
        $folder = 'uploads/ktp';
        $extension = $image->getClientOriginalExtension();
        $image_newname = Str::uuid().".".$extension;
        $image->move($folder, $image_newname);
        
        $client = new Client;
        $base_uri = "http://localhost/PRAK_BACKEND/laravel-uas/public/api";
        $response = $client->request('POST', "{$base_uri}/detail24", [
            'json' => [
                'id' => $request->id,
                'id_user' => Auth::user()->id,
                'address' => $request->address,
                'birthplace' => $request->birthplace,
                'birthdate' => $request->birthdate,
                'agama' => $request->agama,
                'age' => $age,
                'foto_ktp' => $image_newname
            ]
        ]);
        $body = $response->getBody();
        $result = json_decode($body, true);
        $result =  $result['success'];
        if ($response != true) {
            return redirect('/detail24')->with('success_message', 'Detail data gagal ditambahkan!');
        }
        return redirect('/detail24')->with('success_message', 'Detail data berhasil ditambahkan!');
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
    public function edit24($id)
    {
        if (Auth::check()) {
            if (Auth::user()->is_active == 1) {
                $client = new Client;
                $base_uri = "http://localhost/PRAK_BACKEND/laravel-uas/public/api";

                $responseAgama = $client->request('GET', "{$base_uri}/agama24");
                $bodyAgama = $responseAgama->getBody();
                $resultAgama = json_decode($bodyAgama, true);
                $agama =  $resultAgama['data'];
                
                $responseDetail = $client->request('GET', "{$base_uri}/detail24/{$id}/show");
                $bodyDetail = $responseDetail->getBody();
                $resultDetail = json_decode($bodyDetail, true);
                $detail =  $resultDetail['data'];

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
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update24(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'birthplace' => 'required|string|max:150',
            'birthdate' => 'required',
            'agama' => 'required',
            'address' => 'required'
        ]);
        if ($validator->fails()) {
            return redirect('/detail24')->with('success_message', 'Detail data gagal diubah!');
        }

        //count age
        $dob = new DateTime("$request->birthdate");
        $now = new DateTime('today');
        $age = $dob->diff($now)->y;

        //foto ktp
        $image = $request->file('foto_ktp');
        $image_newname = null;
        if ($image != null) {
            $folder = 'uploads/ktp';
            $extension = $image->getClientOriginalExtension();
            $image_newname = Str::uuid().".".$extension;
            $image->move($folder, $image_newname);
        }

        $client = new Client;
        $base_uri = "http://localhost/PRAK_BACKEND/laravel-uas/public/api";
        $response = $client->request('POST', "{$base_uri}/detail24/{$request->id}/edit", [
            'json' => [
                'id' => $request->id,
                'id_user' => Auth::user()->id,
                'address' => $request->address,
                'birthplace' => $request->birthplace,
                'birthdate' => $request->birthdate,
                'agama' => $request->agama,
                'age' => $age,
                'foto_ktp' => $image_newname
            ]
        ]);
        $body = $response->getBody();
        $result = json_decode($body, true);
        $result =  $result['success'];
        if ($response != true) {
            return redirect('/detail24')->with('success_message', 'Detail data gagal diubah!');
        }
        return redirect('/detail24')->with('success_message', 'Detail data berhasil diubah!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy24(Request $request)
    {
        if (Auth::check()) {
            if (Auth::user()->is_active == 1) {
                
                $client = new Client;
                $base_uri = "http://localhost/PRAK_BACKEND/laravel-uas/public/api";
                $response = $client->request('DELETE', "{$base_uri}/detail24/{$request->id}");
                $body = $response->getBody();
                $result = json_decode($body, true);
                $result =  $result['success'];
                if ($response != true) {
                    return redirect('/detail24')->with('success_message', 'Detail data gagal diubah!');
                }
                return redirect('/detail24')->with('success_message', 'Detail data berhasil dihapus!');

            } else {
                return redirect('/');
            }
        } else {
            return redirect('/');
        }
    }
}
