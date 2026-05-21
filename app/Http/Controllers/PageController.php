<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PageController extends Controller
{
    public function about()
    {
        return view('pages.about');
    }

    public function contact()
    {
        return view('pages.contact');
    }

    public function sendContact(Request $request)
    {
        return back()->with('success', 'Mensaje enviado correctamente.');
    }

    // ---- Páginas legales ----

    public function terms()
    {
        return view('pages.legal.terms');
    }

    public function privacy()
    {
        return view('pages.legal.privacy');
    }

    public function shipping()
    {
        return view('pages.legal.shipping');
    }

    public function returns()
    {
        return view('pages.legal.returns');
    }
}
