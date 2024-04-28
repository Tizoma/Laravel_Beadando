<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
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
        if(!Auth::check()){
            return redirect()->route('characters.index');
        }
        return view('characters.list');
    }

    public function details(string $id)
    {
        if(!Auth::check()){
            return redirect()->route('characters.index');
        }
        //Karakter
        $chosenCharacter = DB::table('characters')->find($id);

        //Id-k
        $chosenContestIds = DB::table('character_contest')->where('character_id',$id)->get();
        $contestIdArray=array();
        foreach($chosenContestIds as $chosenContestId){
            array_push($contestIdArray,$chosenContestId->contest_id);
        }

        //Win bool
        $chosenContests= DB::table('contests')->select('win','place_id')->whereIn('id',$contestIdArray)->get();
        $contestWinArray=array();
        foreach($chosenContests as $chosenContest){
            array_push($contestWinArray,$chosenContest->win);
        }

        //Hely nevek
        $placeIdArray = array();
        foreach($chosenContests as $chosenContest){
            array_push($placeIdArray,$chosenContest->place_id);
        }
        $placeNames = DB::table('places')->whereIn('id',$placeIdArray)->get();
        $placeNameArray = array();
        for($i=0;$i<count($placeIdArray);$i++){
            if($i==0){
                array_push($placeNameArray,$placeNames->shift()->name);
            }else{
                $previous=-1;
                for($j=0;$j<count($placeNameArray);$j++){
                    if($placeIdArray[$j]==$placeIdArray[$i]){
                        $previous=$j;
                    }
                }
                if($previous==-1){
                    array_push($placeNameArray,$placeNames->shift()->name);
                }else{
                    array_push($placeNameArray,$placeNameArray[$previous]);
                }
            }
        }

        //Ellenfél nevek
        $otherCharacters = DB::table('character_contest')->select('character_id')->whereIn('contest_id',$contestIdArray)->where('character_id','!=',$id)->get();
        $otherCharacterIdArray=array();
        foreach($otherCharacters as $otherCharacter){
            array_push($otherCharacterIdArray,$otherCharacter->character_id);
        }
        $otherCharacterNames=DB::table('characters')->select('name')->whereIn('id',$otherCharacterIdArray)->get();
        $otherCharacterNameArray = array();
        for($i=0;$i<count($otherCharacterIdArray);$i++){
            if($i==0){
                array_push($otherCharacterNameArray,$otherCharacterNames->shift()->name);
            }else{
                $previous=-1;
                for($j=0;$j<count($otherCharacterNameArray);$j++){
                    if($otherCharacterIdArray[$j]==$otherCharacterIdArray[$i]){
                        $previous=$j;
                    }
                }
                if($previous==-1){
                    array_push($otherCharacterNameArray,$otherCharacterNames->shift()->name);
                }else{
                    array_push($otherCharacterNameArray,$otherCharacterNameArray[$previous]);
                }
            }
        }
        return view('characters.details',['chosenCharacter' => $chosenCharacter
                                            ,'chosenContests' => $chosenContests, 'placeNames' => $placeNames,'otherCharacterNames' => $otherCharacterNames,
                                            'placeNameArray' => $placeNameArray, 'contestWinArray' => $contestWinArray, 'otherCharacterNameArray' => $otherCharacterNameArray
    ]);
    }

    public function create()
    {
        if(!Auth::check()){
            return redirect()->route('characters.index');
        }
        return view('characters.create');
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|max:255',
            'defence' => 'required|integer|max:3|min:0',
            'strength' => 'required|integer|max:20|min:0',
            'accuracy' => 'required|integer|max:20|min:0',
            'magic' => 'required|integer|max:20|min:0',
            'enemy' => 'nullable'
        ],
        [
                'name.required' => 'Name is required!',
                'name.max' => 'The name can only be 255 characters long!',
                'defence.required' => 'You must specify the amount of defence your character has!',
                'defence.max' => "Defence can't be bigger than 3!",
                'defence.min' => "Defence can't go below 0!",
                'strength.required' => 'You must specify the amount of strength your character has!',
                'strength.max' => "Strength can't be bigger than 20!",
                'strength.min' => "Strength can't go below 0!",
                'accuracy.required' => 'You must specify the accuracy of your character!',
                'accuracy.max' => "Accuracy can't be bigger than 20!",
                'accuracy.min' => "Accuracy can't go below 0!",
                'magic.required' => 'You must specify the amount of magic your character has!',
                'magic.max' => "Magic can't be bigger than 20!",
                'magic.min' => "Magic can't go below 0!",

            ]);

        if(($request->strength+$request->accuracy+$request->defence+$request->magic)>20){
            $validator->errors()->add('points',"The total amount of points in defence+strength+accuracy+magic can't exceed 20!" );
        }

        $validated = $validator->validated();
        $character = Character::make($validated);

        $character->owner()->associate(Auth::user());

        $character->save();

        return redirect()->route('characters.index');
    }

    public function edit()
    {
        if(!Auth::check()){
            return redirect()->route('characters.index');
        }
        return view('characters.edit');
    }

    public function destroy(string $id)
    {
        $character = Character::find($id);

        $character->delete();

        return redirect()->route('characters.index');
    }
}
