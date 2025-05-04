<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    //

    public function login(){

        if(Auth::check()){
            return redirect('/');
        }
        return view('pages.auth.login');
    }
    public function authenticate(Request $request): RedirectResponse
    {
        if(Auth::check()){
            return redirect('/');
        }
        $email = $request->input('email');
        $password = $request->input('password');

        // Cek jika keduanya kosong
        if (empty($email) && empty($password)) {
            return back()->withErrors(['email' => 'Email & Password harus diisi!']);
        }
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ], [
            'email.required' => 'Email harus diisi!',
            'email.email' => 'Email tidak valid!',
            'password.required' => 'Password harus diisi!',
        ]);

        // if (Auth::attempt($credentials)) {
        
            $user = User::where('email', $credentials['email'])->first();
            $userSatus = $user;
            
            //Jika user tidak ditemukan ($user kosong/null), ATAU password yang dimasukkan tidak cocok dengan password di database, maka gagal login 
            if (!$user || !Hash::check($credentials['password'], $user->password)) {
                return back()->withErrors(['email' => 'Email atau password salah.'])->onlyInput('email');
            }
            // pengecekan sattus tidak selain approved / !== approved
            if($userSatus->status == 'submitted') {
                // Auth::logout();
                $this->_logout($request);
                return back()->withErrors(['email' => 'Your account is submitted']);
            }
            if($userSatus->status == 'rejected') {
                // Auth::logout();
                $this->_logout($request);
                return back()->withErrors(['email' => 'Your account is rejected']);
            }
        // }
        Auth::login($user);
        $request->session()->regenerate();
        return redirect()->intended('dashboard')->with('success', 'Selamat Datang Kembali...');
        //     return back()->withErrors([
        //     'email' => 'Terjadi kesalahan periksa kembali Email & Password anda...',
        // ])->onlyInput('email');
    }

    
    public function registerView(){
        if(Auth::check()){
            return redirect('/');
        }
        return view('pages.auth.register');
    }
    
    public function register(Request $request){
        if(Auth::check()){
            return redirect('/');
        }

        $validate = $request->validate([
            'name' => ['required'],
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);
        
        $user = new User();
        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->password = Hash::make($request->input('password'));
        $user->role_id = 2; //=> User (Penduduk)
        $user->saveOrFail();
        
        return redirect('/')->with('success','Akun anda sudah terdaftar, menunggu persetujuan Admin!');
        
    }

    public function _logout(Request $request)
    {
            Auth::logout();

                $request->session()->invalidate();

                $request->session()->regenerateToken();
        }  
        public function logout(Request $request): RedirectResponse
        {
            if(!Auth::check()){
                return redirect('/');
            }
            $this->_logout($request);

            return redirect('/');
        }
}
