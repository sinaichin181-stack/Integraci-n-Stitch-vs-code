<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class AuthController extends Controller
{
    public function register(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email'],
            'password' => ['required', 'string', 'min:8'],
            'favorite_actor' => ['required', Rule::in(['mina-park', 'dylan-wu', 'sora-han', 'ji-ho-kim'])],
            'favorite_genre' => ['required', Rule::in(['romance-fantasy', 'music-history', 'contemporary-bl', 'mystery-thriller'])],
            'terms' => ['accepted'],
            'updates' => ['sometimes', 'boolean'],
        ], [
            'name.required' => 'El nickname es obligatorio.',
            'email.required' => 'El correo electrónico es obligatorio.',
            'email.email' => 'Introduce un correo electrónico válido.',
            'email.unique' => 'Ya existe una cuenta con este correo electrónico.',
            'password.min' => 'La contraseña debe tener al menos 8 caracteres.',
            'favorite_actor.required' => 'Elige tu actor favorito.',
            'favorite_actor.in' => 'El actor seleccionado no es válido.',
            'favorite_genre.required' => 'Elige tu género favorito.',
            'favorite_genre.in' => 'El género seleccionado no es válido.',
            'terms.accepted' => 'Debes aceptar las reglas y la política de privacidad.',
        ]);

        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
            'favorite_actor' => $validated['favorite_actor'],
            'favorite_genre' => $validated['favorite_genre'],
            'updates' => $validated['updates'] ?? false,
            'terms_accepted_at' => now(),
        ]);

        Auth::login($user);
        $request->session()->regenerate();

        return redirect()->route('profile.edit')->with('status', 'Tu FanID se creó correctamente.');
    }

    public function login(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'email' => ['required', 'string', 'max:255'],
            'password' => ['required', 'string'],
            'remember' => ['sometimes', 'boolean'],
        ], [
            'email.required' => 'Introduce tu correo electrónico o handle.',
            'password.required' => 'Introduce tu contraseña.',
        ]);

        $identifier = trim($validated['email']);
        $isEmail = filter_var($identifier, FILTER_VALIDATE_EMAIL) !== false;
        $loginField = $isEmail ? 'email' : 'handle';
        $loginValue = $isEmail ? $identifier : ltrim($identifier, '@');

        if (! Auth::attempt([
            $loginField => $loginValue,
            'password' => $validated['password'],
        ], $request->boolean('remember'))) {
            return back()
                ->withErrors(['auth' => 'Las credenciales no coinciden con nuestros registros.'])
                ->onlyInput('email');
        }

        $request->session()->regenerate();

        return redirect()->intended(route('profile.edit'))->with('status', 'Has iniciado sesión correctamente.');
    }
}