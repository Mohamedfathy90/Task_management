<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;
use Illuminate\Validation\ValidationException;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $user = User::find($request->id);
        
        if($user->password != null)
        {
        throw ValidationException::withMessages(['id' => 'This user is already registered , please log in !']);
        }
        
        else{
            $request->validate([
                'id' => ['required', 'exists:users,id'],
                'password' => ['required', 'confirmed'],
            ]);
            $user->update(['password'=>Hash::make($request->password)]);
            Auth::login($user);
            // event(new Registered($user));
            return redirect(RouteServiceProvider::HOME);
        }
              
    }
}
