<?php

use Illuminate\Http\Request;
use App\Models\Order;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        return $user->orders;
    }

    public function store(Request $request)
    {
        $request->validate([
            'items' => 'required|array',
            'total_price' => 'required|numeric',
        ]);

        $order = Auth::user()->orders()->create($request->all());

        return response()->json($order, 201);
    }
}

