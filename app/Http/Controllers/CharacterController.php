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

class CharacterController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->except(['index']);
    }

    public function index()
    {
        return view('characters.index', ['characterCount' => Character::count(), 'contestCount' => Contest::count()]);
    }

    public function list()
    {
        return view('characters.list');
    }

    public function details(string $id)
    {
        $chosenContestIds = DB::table('character_contest')->select('contest_id')->where('character_id','=',$id)->get();

        $idarray=array();
        foreach($chosenContestIds as $chosenContestId){
            array_push($idarray,$chosenContestId->contest_id);
        }
        $placeIds = DB::table('contests')->select('place_id')->where('character_id','=',$id)->get();
        return view('characters.details',['chosenCharacter' => DB::table('characters')->find($id),'chosenContests' => DB::table('contests')->whereIn('id',$idarray)->get()
                                            ,'otherCharacters' => DB::table('character_contest')->select('character_id')->whereIn('contest_id',$idarray)->where('character_id','!=',$id)->get()
    ]);
    }

    // DB::table('contests')->whereIn('id',[1,2,3])->get()
}
