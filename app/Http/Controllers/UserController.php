<?php

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        return User::where('role', 'customer')->get();
    }

    public function show($id)
    {
        return User::where('role', 'customer')->findOrFail($id);
    }
}

