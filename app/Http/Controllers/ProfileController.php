<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    public function index($id) {
        $user = User::findOrFail($id);

        return view('pages.profile.index', [
            'user' => $user
        ]);
    }

    public function edit($id) {
        $user = User::findOrFail($id);

        return view('pages.profile.edit', [
            'user' => $user
        ]);
    }

    public function update(Request $request, $id)
    {
        $data = $request->all();

        $user = User::findorfail($id);

        $user->update($data);

        return redirect()->route('profile', $user->id);
    }
}
