<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Workshop;
use App\User;
use App\Idea;
use App\Rating;
use App\Group;

class FacilitatorController extends Controller
{

    //
public function createWorkshop(Request $r){

       // $user = User::where('id',$id)->first();
       if($r->nbPar < 5 ){
        return redirect()->to('/home');
       }
        $w = new Workshop();
        $w->Title = $r->title;
        $w->Problem = $r->problem;
        $w->nb_users = $r->nbPar;
        $w->facilitator()->associate($r->user());
        $w->link = $this->randomLink(10);
        $w->save();
        $r->user()->workshop()->associate($w);
        $r->user()->save();
        return redirect()->to('/home');

}


public function kickUser(Request $r) {
    $id = $r->userid;
    $user = User::where('id',$id)->first();
    //dd($user);
    $user->workshop_id = 0;
    $user->save();
    return redirect()->to('/workshop');
}

public function kick(Request $r) {
    return redirect()->to('/workshop');
}


function randomLink($length = 10) {
    do {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charLength - 1)];
        }
    } while (Workshop::where('link',$randomString)->count() != 0);

    return $randomString;
}


    public function beginWorkshop (Request $r) {
        //dd($r->user()->workshop);
        if ($r->user()->role == 1) {
        $w = $r->user()->workshop;
        $w->stage = 1;
        $w->nb_users = $w->users()->count()-1;
        $w->save();
        $w = $r->user()->workshop;
        }
        return redirect()->to('/workshop');
    }

    
    public function beginRounds (Request $r) {
        if ($r->user()->role == 1) {
            $w = $r->user()->workshop;
            $w->stage = 2;
            $w->round = 1;
            foreach($w->ideas as $idea){
                $idea->taken = 0;
                $idea->rating = 0;
                $idea->save();
            }
            $this->shuffleIdeas($r);
            $w->save();
            return redirect()->to('/workshop');
        }

    }

    public function nextRound(Request $r){
        $w = $r->user()->workshop;
        $w->round += 1;
        $w->nbRates = 0;
        if($w->round > 5){
            $w->stage = 3;
            $w->save();
            //return redirect()->to('/workshop');
        }

        foreach($w->ideas as $idea){
            $idea->taken = 0;
            $idea->save(); 
        }
    
        //dd($w->ideas);
        $w->save();
        $this->shuffleIdeas($r);
        return redirect()->to('/workshop');
    }


    public function shuffleIdeas(Request $r){
        foreach($r->user()->workshop->ideas as $idea){
            $idea->taken = 0;
            $idea->save();
        }
        if($r->user()->role == 1){
            $users = $r->user()->workshop->users;
            $ideas = $r->user()->workshop->ideas;
            $array = array();
            for($i = 0; $i< $ideas->count() ; $i++){
                $array[$i] = $ideas[$i]->id;
            }
            shuffle($array);
            $w = $r->user()->workshop;
            //dd($array);
            do {
                foreach($w->ideas as $idea){
                    $idea->taken = 0;
                    $idea->save(); 
                }
                //dd($ideas);
                $cond = false;
                foreach($users as $u) {
                    if ($u->id != $r->user()->id){
                        $bool = false;
                        for($j = 0; $j < $ideas->count() ; $j++) {
                            $i = Idea::where('id',$array[$j])->first();
                            if ($i->user->id != $u->id && $i->taken == 0 && (Rating::where('user_id',$u->id)->where('idea_id',$i->id)->count() == 0)) {
                                $u->ItoRate = $i->id;
                                $i->taken = 1;
                                $u->save();
                                $i->save();
                                $bool= true;
                                break;
                            }
                        }
                        if ($bool == false)  {
                            $cond = true;
                            break;
                        }
                    }
                }
               // dd($users);
            } while ($cond);
            return redirect()->to('/workshop');
        }
    }

    
    public function makeGroups(Request $r){
        $arrayIdeas = $r->groups;
        $w = $r->user()->workshop;
        if($w->stage == 3){
            if($arrayIdeas == null){
                 return redirect()->to('/workshop');
            }
            foreach($arrayIdeas as $id){
                $idea = Idea::where('id',$id)->first();
                //$w = $idea->workshop;
                $group = new Group();
                $group->idea()->associate($idea);
                $group->workshop()->associate($w);
                $group->save();
                // $w->stage = 4;
                // $w->save();
            }
            $w->stage = 4;
            //$w->round = 6 ; ??
            $w->save();
            return redirect()->to('/workshop/showgroups');
        }
        if($w->stage == 4 ){
            return redirect()->to('/workshop/showgroups');
        }
    }

     public function showGroups(Request $r)
    {
        
        //dd($r->user());
        if($r->user()->role == 0){
            // if($w->stage == 5){
            if($r->user()->workshop == null){
                return view('user.finalized');
            }
            if($r->user()->group_id == 0){
                $w = $r->user()->workshop ;
                $groups = $w->groups ;
                return view('user.joingroup',compact('groups'));
            }
            else {
                return view('user.showmygroup');
            }
        }
        else if($r->user()->role == 1){
            $w = $r->user()->workshop ;
            $groups = $w->groups ;
            if($w->stage == 5){
                return view('facilitator.finish');
            }
            return view('facilitator.viewgroups',compact('groups'));
        }
    }

    public function kickFromGroup(Request $r){
        $id  = $r->userid;
        $user = User::where('id',$id)->first();
        $user->group_id = 0 ;
        $user->save();
        return redirect()->to('/workshop/showgroups');
    }


    public function finish(Request $r){
        $w = $r->user()->workshop;
        $users = $w->users;
        $w->stage=5;
        $w->save();
        foreach($users as $user){
            $user->workshop_id = 0;
            $user->group_id =0 ;
            $user->ItoRate=0;
            $user->save();
            return view('facilitator.finish');
        }
    }

    public function home(Request $r){
        return redirect()->to('/home');
    }




}
