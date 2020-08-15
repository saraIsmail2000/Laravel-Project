<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Workshop;
use App\User;
use App\Idea;
use App\Rating;
use App\Group;

class UserController extends Controller {

    public function joinWorkshop(Request $r){
        $wLink = $r->link;
        $workshop = Workshop::where('Link',$wLink)->first();
        if($workshop == null) return "This workshop is not found .";
        if($workshop->users()->count() >= ($workshop->nb_users+1) ){
            return "This workshop's number of participants is completed ! Sorry :)";
        }
        if($workshop->stage != 0){
            return "This workshop already started before , you can't join anymore.";
        }
    
        $workshop->users()->save($r->user());
        return redirect()->to('/home');
    }


      public function submitSolution(Request $r) {
        if(isset($_POST['submit'])){
        $idea = new Idea();
        $idea->user()->associate($r->user());
        $idea->solution = $r->idea;
        $idea->workshop()->associate($r->user()->workshop);
        $idea->save();
        $w =$idea->workshop;
       // dd($w->ideas);
        // if($w->ideas()->count() == ($w->nb_users -1) ){ //-1 added ?
        //     $w->stage = 2;
        //     $w->save();
        // }
    }
        return redirect()->to('/workshop');
    
}


    // public function shuffleIdeas(Request $r){
    //     if($r->user()->role == 1){
    //         return redirect()->to('/workshop');
    //     }
    //     else if($r->user()->role == 0){
    //     $user = $r->user();
    //     $w = $user->workshop;
    //     if(Rating::where('user_id',$user->id)->count() == $w->round){
    //         return view('user.waitRound');
    //     }
    //     $ideas = Idea::where('workshop_id',$w->id)->get();
    //     $array = array();
    //     for($i = 0; $i< $ideas->count() ; $i++){
    //         $array[$i] = $ideas[$i]->id;
    //     }
    //     shuffle($array);
    //     do {
    //         $randomIndex = array_rand($array);
    //         $idea = Idea::where('id',$array[$randomIndex])->first();
    //     }while ($idea->user->id == $r->user()->id || $idea->taken==true || (Rating::where('user_id',$r->user()->id)->where('idea_id',$idea->id)->count() != 0));
    //     $idea->taken = true;
    //     $idea->save();
    //     return view('user.IdeaRating',compact('idea'));
    // }

    // }

    public function ideatorate (Request $r) {
        // dd($r->user());
        $w = $r->user()->workshop;
        if($w->stage == 4){
            return redirect()->to('/workshop/showgroups');
        }
        if(Rating::where('user_id',$r->user()->id)->where('workshop_id',$r->user()->workshop->id)->count() == $r->user()->workshop->round){
            return view('user.waitRound');
        }
        $idea = Idea::where('id',$r->user()->ItoRate)->first();
        return view('user.IdeaRating',compact('idea'));
    }

    public function RateIdea(Request $r){
        $rate = $r->ratings;
        $ideaId = $r->myRate;
        $idea = Idea::where('id',$ideaId)->first();
        $idea->rating += $rate;
        $w = $r->user()->workshop;
        $w->nbRates ++;
        $w->save();
        //dd($w);
        $rating = new Rating();
        $rating->user_id = $r->user()->id;
        $rating->idea_id = $ideaId;
        $rating->workshop_id = $w->id;
        $rating->save();
        $idea->save();
        return redirect()->to('/workshop');
    }


    public function joinGroup(Request $r){
        $grpId = $r->join;
        $group  = Group::where('id',$grpId)->first();
        $group->users()->save($r->user());
        $r->user()->group()->associate($group);
        return redirect()->to('/workshop/showgroups');
    }

    public function exitGroup(Request $r){
        $user = $r->user();
        $user->group_id = 0 ;
        $user->save();
        return redirect()->to('/workshop/showgroups');
    }


    public function history (Request $r) {
        $workshops = Workshop::where('facilitator_id',$r->user()->id)->orderBy('created_at','ASC')->get();
        $ideas = Idea::where('user_id',$r->user()->id)->get();
        return view('user/history',compact('workshops','ideas'));
    }





}

