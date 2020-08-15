<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Idea;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */

    public function index(Request $r) {
        if ($r->user()->role == 2) {
            //Admin
            $users = User::where('approved',false)->get();
            return view('admin.viewusers',compact('users'));
        }
        elseif($r->user()->approved == true){
            if($r->user()->role == 1){
                 //Approved facilitator
                if ($r->user()->workshop_id != 0) {
                    return redirect()->to('/workshop');
    
                } else {
                    return view('facilitator.createworkshop');
                }
            }
            else{
                 //Approved user

                 if($r->user()->workshop_id == 0){   //  --> here the user is not joined to a workshop yet
                    return view ('user.joinworkshop');
                 }

                 //already joined to a workshop
                 else return redirect()->to('/workshop');

            }
        }
        else{
            //Not Approved
            return view('user.notapproved');
        }
    }


    public function viewWorkshop (Request $r) {
        if($r->user()->workshop == null){
            return redirect()->to('/home');
        }
        $w = $r->user()->workshop;

        //Facilitator:
        if ($r->user()->role == 1) {

            //Waiting to start the workshop 
            //stage 0 means the workshop is created and participants are joining but it is not started yet
            if ($w->stage == 0) {
                return view ('facilitator.viewjoiningusers',compact('w'));
            }

            //Users submiting ideas 
            //stage 1 workshop started and participants are submitting the ideas
            //stage 2 shuffling and rating 
            if ($w->stage == 1 || $w->stage == 2) {
                return view ('facilitator.viewideas',compact('w'));
            }

            //stage 3  ,Sort ideas by rate and make groups
            if ($w->stage == 3) {
                return view ('facilitator.viewideas',compact('w'));
            }

            //when the facilitator generate the groups the stage become 4

            if ($w->stage == 4) {
                return redirect()->to('/workshop/showgroups');
            }

            if($w->stage == 5){
                return view('facilitator.finish');
            }

        }

        //User
        if ($r->user()->role == 0) {
            if($r->user()->workshop_id == 0) return redirect()->to('/home');
            
            //Waiting for workshop to start
            if ($w->stage == 0) {
                return view ('user.waitingWorkshop');
            }

            //Users submiting ideas
            if ($w->stage == 1) {
                
                $check = Idea::where('user_id',$r->user()->id)->where('workshop_id',$w->id)->count() ;
                if($check == 0){      // --> this condition means that the user didnt submit a solution yet for this workshop
                    return view ('user.submitidea');  
                }
                // if ($r->user()->idea == null)    // --> here the user didn't a solution yet
                //     return view ('user.submitidea');
                else
                    //wait till all the participants submit their solutions
                    return view ('user.waitingforAll',compact('w'));
            }

            //when all users submit there solutions the stage of the workshop turns to 2

            //Users rating and shuffling
            if ($w->stage == 2) {
                //$ideas = $w->ideas;
                return redirect()->to('/workshop/rating');
            }

            if ($w->stage == 3) {
                return view('user.waitforgroups');
            }

            //groups level 
            if ($w->stage == 4) {
                return redirect()->to('/workshop/showgroups');
            }

            if($w->stage == 5){
                return view('user.finalized');
            }

        }
    }


   
}
