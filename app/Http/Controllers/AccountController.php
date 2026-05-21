<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AccountController extends Controller
{
    public function index()
    {
        return view('account.index');
    }

    public function orders()
    {
        return view('account.orders');
    }

    public function orderDetail($order)
    {
        return view('account.order-detail', compact('order'));
    }

    public function addresses()
    {
        return view('account.addresses');
    }
}
