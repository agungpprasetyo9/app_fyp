<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
class AuthController extends Controller
{
    public function __construct(){
        // $this->middleware('web');
    }

    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email:dns',
            'password' => 'required',
        ]);
    
        if (Auth::attempt($credentials)) {
            $user = Auth::user();
            $request->session()->regenerate();
            if($user->is_admin) {
                return redirect()->intended(route('admin.dashboard'));
                // return redirect('student.dashboard');
            }else {
                return redirect()->intended(route('student.dashboard'));
                // return redirect('admin.dashboard');
            }
        }
        return redirect()->back()->with('loginError', 'Login Failed');

        // return redirect()->back()->withErrors([
        //     'email' => 'Invalid email or password.',
        // ]);
    }

    public function showRegistrationForm()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        $request->validate([
            'username' => 'required|string|max:255',
            'email' => 'required|string|email|unique:users|max:255',
            'password' => 'required|string|min:8|confirmed',
        ]);

        // Create a new user
        $user = new User();
        $user->username = $request->input('username');
        $user->email = $request->input('email');
        $user->password = Hash::make($request->input('password'));
        $user->save();
        
        // Set session
        Session::put('user_id', $user->id);
        Session::put('username', $user->name);


        // Optionally, you can authenticate the user immediately after registration
        auth()->login($user);

        // Redirect the user to their dashboard or any other desired page

        return redirect()->route('/login');
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
