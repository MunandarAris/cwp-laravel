<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use GuzzleHttp\Client;

class Auth24Controller extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index24()
    {
        //dashboard or login page
        if (Auth::check()) {
            if (Auth::user()->role == 'Admin') {
                return view('admin.dashboard');
            } else {
                return view('user.dashboard');
            }
        } else {
            return view('auth.login');
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create24()
    {
        //register
        if (Auth::check()) {
            if (Auth::user()->role == 'Admin') {
                return view('admin.dashboard');
            } else {
                return view('user.dashboard');
            }
        }
        return view('auth.register');
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
        $response = $client->request('POST', "{$base_uri}/register24", [
            'json' => [
                'name' => $request->name,
                'email' => $request->email,
                'password' => $request->password
            ]
        ]);
        $body = $response->getBody();
        $result = json_decode($body, true);
        $result =  $result['success'];
        if ($response != true) {
            return back()->with('success_message', 'Registrasi gagal!');
        }
        return redirect('/login24')->with('success_message', 'Registrasi berhasil!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show24(Request $request)
    {
        //login process
        $request->validate([
            'email' => 'required|string|max:150|email',
            'password' => 'required|string|min:8'
        ]);

        $result = auth()->attempt([
            'email' => $request->email,
            'password' => $request->password
        ]);

        if ($result) {
            $request->session()->regenerate();
            if (Auth::user()->role == 'Admin') {
                return view('admin.dashboard');
            } else {
                return view('user.dashboard');
            }
        } else {
            dd('gagal');
            return back()->with('error_message', 'Login gagal! Silakan cek email atau password.');
        }        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit24()
    {
        //to user profile
        if (Auth::check()) {
            if (Auth::user()->role == 'Admin') {
                return view('admin.profile');
            } else {
                if (Auth::user()->is_active == 1) {
                    return view('user.profile');
                } else {
                    return redirect('/')->with('error_message', 'Fitur tidak dapat diakses, pengguna belum aktif!');
                }
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
    public function destroy24()
    {
        //logout
        if (Auth::check()) {
            Auth::logout();
        }
        return redirect('/');
    }

    public function editPassword24()
    {
        if (Auth::check()) {
            if (Auth::user()->is_active == 1) {
                return view('auth.password');
            } else {
                return redirect('/')->with('error_message', 'Fitur tidak dapat diakses, pengguna belum aktif!');
            }
        } else {
            return redirect('/')->with('error_message', 'Silakan login kembali!');
        }
    }

    public function updatePassword24(Request $request) {
        if (Auth::check()) {
            if (Auth::user()->is_active == 1) {
                $request->validate([
                    'newpass' => 'required',
                    'confirmpass' => 'required'
                ]);
                if ($request->newpass == $request->confirmpass) {
                    $client = new Client;
                    $base_uri = "http://localhost/PRAK_BACKEND/laravel-uas/public/api";
                    $response = $client->request('POST', "{$base_uri}/password24", [
                        'json' => [
                            'id' => Auth::user()->id,
                            'newpass' => $request->newpass
                        ]
                    ]);
                    $body = $response->getBody();
                    $result = json_decode($body, true);
                    $result =  $result['success'];
                    if ($response != true) {
                        return back()->with('success_message', 'Password gagal diubah!');
                    }
                    return redirect('/profile24/')->with('success_message', 'Password berhasil diubah!');
                } else {
                    return redirect('/profile24/')->with('error_message', 'Password gagal diubah! Pastikan password dan konfirmasi password sama!');
                }
            } else {
                return redirect('/')->with('error_message', 'Fitur tidak dapat diakses, pengguna belum aktif!');
            }
        } else {
            return redirect('/')->with('error_message', 'Silakan login kembali!');
        }
    }

    public function editImage24()
    {
        //update image
        if (Auth::check()) {
            if (Auth::user()->is_active == 1) {
                return view('auth.profilepic');
            } else {
                return redirect('/')->with('error_message', 'Fitur tidak dapat diakses, pengguna belum aktif!');
            }
        } else {
            return redirect('/')->with('error_message', 'Silakan login kembali!');
        }
    }

    public function updateImage24(Request $request) {
        if (Auth::check()) {
            if (Auth::user()->is_active == 1) {
                $request->validate([
                    'upload_image' => 'required'
                ]);
                $image = $request->file('upload_image');
                $folder = 'uploads/profile';
                $extension = $image->getClientOriginalExtension();
                $image_newname = Str::uuid().".".$extension;
                $image->move($folder, $image_newname);
                
                $client = new Client;
                $base_uri = "http://localhost/PRAK_BACKEND/laravel-uas/public/api";
                $response = $client->request('POST', "{$base_uri}/image24", [
                    'json' => [
                        'id' => Auth::user()->id,
                        'image_newname' => $image_newname
                    ]
                ]);
                $body = $response->getBody();
                $result = json_decode($body, true);
                $result =  $result['success'];
                if ($response != true) {
                    return redirect('/profile24')->with('success_message', 'Foto profil gagal diubah!');
                }
                return redirect('/profile24')->with('success_message', 'Foto profil berhasil diubah!');
            } else {
                return redirect('/')->with('error_message', 'Fitur tidak dapat diakses, pengguna belum aktif!');
            }
        } else {
            return redirect('/')->with('error_message', 'Silakan login kembali!');
        }
    }
}
