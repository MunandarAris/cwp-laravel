<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

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
        //register process
        $request->validate([
            'name' => 'required|string|max:150',
            'email' => 'required|string|max:150|email|unique:users',
            'password' => 'required|string|min:8'
        ]);

        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->save();

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
            return back()->with('error_message', 'Login gagal! Silakan cek email atau password.');
        }        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit24($id)
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

    public function updateImage24(Request $request) {
        if (Auth::check()) {
            if (Auth::user()->is_active == 1) {
                $request->validate([
                    'upload_image' => 'required'
                ]);
                $user = User::find(Auth::user()->id);
                $image = $request->file('upload_image');
                $folder = 'uploads/profile';
                $extension = $image->getClientOriginalExtension();
                $image_newname = Str::uuid().".".$extension;
                $image->move($folder, $image_newname);
                $user->photo = $image_newname;
                $user->save();
                return redirect('/profile24/'.Auth::user()->id)->with('success_message', 'Foto profil berhasil diubah!');
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
                    $user = User::find(Auth::user()->id);
                    $user->password = Hash::make($request->newpass);
                    $user->save();
                    return redirect('/profile24/'.Auth::user()->id)->with('success_message', 'Password berhasil diubah!');
                } else {
                    return redirect('/profile24/'.Auth::user()->id)->with('error_message', 'Password gagal diubah! Pastikan password dan konfirmasi password sama!');
                }
            } else {
                return redirect('/')->with('error_message', 'Fitur tidak dapat diakses, pengguna belum aktif!');
            }
        } else {
            return redirect('/')->with('error_message', 'Silakan login kembali!');
        }
    }
}
