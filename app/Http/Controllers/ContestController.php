<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Session;
use App\Models\Character;
use App\Models\Contest;

use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class ContestController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        return view('contests.index');
    }


    public function create()
    {
        return view('contests.create');
    }
}
