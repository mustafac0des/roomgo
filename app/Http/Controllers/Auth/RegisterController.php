<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    use RegistersUsers;

    protected $redirectTo = '/';

    public function __construct()
    {
        $this->middleware('guest');
    }

    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'gender' => ['required', 'in:male,female'],
            'address' => ['required', 'string', 'max:255'],
            'phone' => ['required', 'string', 'max:15'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'picture' => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif,svg', 'max:2048'],
            'role' => ['nullable', 'in:user,admin'],
        ]);
    }

    protected function create(array $data)
    {
        $role = isset($data['role']) && !is_null($data['role']) ? $data['role'] : 'user';

        $picturePath = null;
        if (isset($data['picture']) && $data['picture'] instanceof \Illuminate\Http\UploadedFile) {
            $picturePath = $data['picture']->store('profile_pictures', 'public');
        }

        $user = User::create([
            'name' => $data['name'],
            'gender' => $data['gender'],
            'address' => $data['address'],
            'phone' => $data['phone'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'picture' => $picturePath,
            'role' => $role,
        ]);

        session()->flash('user', $user);

        return $user;
    }

    protected function registered(Request $request, $user)
    {
        return redirect()->to('/')->with('status', 'Registration Successful!');
    }
}

