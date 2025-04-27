<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function update(Request $request, string $id) {
        $user = User::find($id);
        $user->update($request->all());
    }
}
