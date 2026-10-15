<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

class ProfileController extends Controller
{
    public function update(Request $request): RedirectResponse
    {
        $handle = trim((string) $request->input('handle', ''));
        if (str_starts_with($handle, '@')) {
            $handle = substr($handle, 1);
        }
        $request->merge(['handle' => $handle === '' ? null : $handle]);

        $user = $request->user();
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'handle' => [
                'nullable',
                'string',
                'max:30',
                'alpha_dash',
                Rule::unique('users', 'handle')->ignore($user->id),
            ],
            'bio' => ['nullable', 'string', 'max:1000'],
            'city' => ['nullable', 'string', 'max:100'],
            'avatar' => ['nullable', 'image', 'max:2048'],
        ], [
            'name.required' => 'El nombre es obligatorio.',
            'handle.alpha_dash' => 'El handle solo puede contener letras, números, guiones y guiones bajos.',
            'handle.unique' => 'Este handle ya está en uso.',
            'bio.max' => 'La biografía no puede superar los 1000 caracteres.',
            'city.max' => 'La ciudad no puede superar los 100 caracteres.',
            'avatar.image' => 'El avatar debe ser una imagen válida.',
            'avatar.max' => 'El avatar no puede superar los 2 MB.',
        ]);

        $oldAvatarPath = $user->avatar_path;
        if (isset($validated['avatar'])) {
            $validated['avatar_path'] = $validated['avatar']->store('avatars', 'public');
            unset($validated['avatar']);
        }

        $user->fill($validated)->save();

        if (isset($validated['avatar_path']) && $oldAvatarPath) {
            Storage::disk('public')->delete($oldAvatarPath);
        }

        return redirect()->route('profile.edit')->with('status', 'Tu perfil se actualizó correctamente.');
    }
}