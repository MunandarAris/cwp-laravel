<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use GuzzleHttp\Client;

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
                $client = new Client;
                $base_uri = "http://localhost/PRAK_BACKEND/laravel-uas/public/api";
                $response = $client->request('GET', "{$base_uri}/details24");
                $body = $response->getBody();
                    
                $result = json_decode($body, true);
                $data =  $result['data'];
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
    public function indexApproval24()
    {
        if (Auth::check()) {
            if (Auth::user()->role == 'Admin') {
                $client = new Client;
                $base_uri = "http://localhost/PRAK_BACKEND/laravel-uas/public/api";
                $response = $client->request('GET', "{$base_uri}/approval24");
                $body = $response->getBody();
                    
                $result = json_decode($body, true);
                $user =  $result['data'];
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
                $client = new Client;
                $base_uri = "http://localhost/PRAK_BACKEND/laravel-uas/public/api";
                $response = $client->request('POST', "{$base_uri}/approval24", [
                    'json' => [
                        'id' => $request->id
                    ]
                ]);
                $body = $response->getBody();

                $result = json_decode($body, true);
                $user =  $result['data'];
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
                $client = new Client;
                $base_uri = "http://localhost/PRAK_BACKEND/laravel-uas/public/api";
                $response = $client->request('GET', "{$base_uri}/details24/{$id}");
                $body = $response->getBody();
                    
                $result = json_decode($body, true);
                $data =  $result['data'];
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
