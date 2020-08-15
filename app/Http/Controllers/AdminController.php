<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class AdminController extends Controller {
    
    public function approveUser(Request $r) {
        $id = $r->userid;
        $user = User::where('id',$id)->first();
        $user->approved = true;
        $user->save();
        return redirect()->to('/home');
    }

    public function approve(Request $r) {
        return redirect()->to('/home');
    }
}


