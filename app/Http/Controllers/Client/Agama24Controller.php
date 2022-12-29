<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Auth;

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
                $client = new Client;
                $base_uri = "http://localhost/PRAK_BACKEND/laravel-uas/public/api";
                $response = $client->request('GET', "{$base_uri}/agama24");
                $body = $response->getBody();
                
                $result = json_decode($body, true);
                $data =  $result['data'];
                // dd($data);
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
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store24(Request $request)
    {
        $client = new Client;
        $base_uri = "http://localhost/PRAK_BACKEND/laravel-uas/public/api";
        $response = $client->request('POST', "{$base_uri}/agama24", [
            'json' => [
                'name' => $request->name
            ]
        ]);
        $body = $response->getBody();
        $result = json_decode($body, true);
        $result =  $result['success'];
        if ($response != true) {
            return redirect('/agama24')->with('success_message', 'Agama gagal ditambahkan!');
        }
        return redirect('/agama24')->with('success_message', 'Agama berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show24($id)
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
            if (Auth::user()->role == 'Admin') {
                $client = new Client;
                $base_uri = "http://localhost/PRAK_BACKEND/laravel-uas/public/api";
                $response = $client->request('GET', "{$base_uri}/agama24/{$id}");
                $body = $response->getBody();
                
                $result = json_decode($body, true);
                $agama =  $result['data'];
                // dd($data);
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
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update24(Request $request)
    {
        $client = new Client;
        $base_uri = "http://localhost/PRAK_BACKEND/laravel-uas/public/api";
        $response = $client->request('PUT', "{$base_uri}/agama24/{$request->id}", [
            'json' => [
                'id' => $request->id,
                'name' => $request->name
            ]
        ]);
        $body = $response->getBody();
        $result = json_decode($body, true);
        $result =  $result['success'];
        if ($response != true) {
            return redirect('/agama24')->with('success_message', 'Agama gagal diubah!');
        }
        return redirect('/agama24')->with('success_message', 'Agama berhasil diubah!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy24(Request $request)
    {
        $client = new Client;
        $base_uri = "http://localhost/PRAK_BACKEND/laravel-uas/public/api";
        $response = $client->request('DELETE', "{$base_uri}/agama24/{$request->id}", [
            'json' => [
                'id' => $request->id
            ]
        ]);
        $body = $response->getBody();
        $result = json_decode($body, true);
        $result =  $result['success'];
        if ($response != true) {
            return redirect('/agama24')->with('success_message', 'Agama gagal dihapus!');
        }
        return redirect('/agama24')->with('success_message', 'Agama berhasil dihapus!');
    }
}
