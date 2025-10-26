<?php

namespace App\Http\Controllers\Publik;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ProfilBalai;

class ProfilBalaiController extends Controller
{
    public function index()
    {
        $profil = ProfilBalai::first();
        return view('publik.profil-balai', compact('profil'));
    }
}
