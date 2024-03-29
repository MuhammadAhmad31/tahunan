<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;
use App\Models\Admin\SchoolModel;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        $schools = SchoolModel::all();
        $schoolProperties = [];

        foreach ($schools as $school) {
            $schoolProperties[] = [
                'id' => $school->id,
                'name' => $school->name,
            ];
        }

        return view('auth.register', ['schools' => $schoolProperties]);
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'id_school' => ['required', 'exists:schools,id'],
            'date_of_birth' => ['nullable', 'date'],
            'nisn' => ['required', 'string', 'max:255'],
            'parent_name' => ['required', 'string', 'max:255'],
            'profile_photo_path' => ['required', 'file', 'max:5000'],
            'id_card_parent' => ['required', 'file', 'max:5000', 'mimes:jpeg,jpg,png,pdf'],
            'id_family_card' => ['required', 'file', 'max:5000', 'mimes:jpeg,jpg,png,pdf'],
            'kip' => ['nullable', 'image', 'max:5000', 'mimes:jpeg,jpg,png,pdf'],
            'is_boarding' => ['required', 'boolean'],
        ]);


        $user = User::create([
            'id' => date('YmdHis') . mt_rand(10000, 99999),
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'id_school' => $request->id_school,
            'date_of_birth' => $request->date_of_birth,
            'nisn' => $request->nisn,
            'parent_name' => $request->parent_name,
            'profile_photo_path' => $request->file('profile_photo_path') ? $request->file('profile_photo_path')->store('profile-photos', 'public') : null,
            'id_card_parent' => $request->file('id_card_parent') ? $request->file('id_card_parent')->store('id-card-parents', 'public') : null,
            'id_family_card' => $request->file('id_family_card') ? $request->file('id_family_card')->store('id-family-cards', 'public') : null,
            'kip' => $request->file('kip') ? $request->file('kip')->store('kips', 'public') : null,
            'is_boarding' => $request->is_boarding,
        ]);

        event(new Registered($user));

        Auth::login($user);

        return redirect(route('admin.dashboard', absolute: false));
    }
}
