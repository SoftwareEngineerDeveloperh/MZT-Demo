<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Models\Candidate;
use App\Models\Company;
use App\Models\Wallet;
use Illuminate\Support\Facades\Mail;
use App\Mail\MztSendMail;

class CandidateController extends Controller
{
    public function index(){
    $candidates = Candidate::all();
    $coins = Wallet::where('company_id', 1)->find(1)->coins;
    return view('candidates.index', compact('candidates', 'coins'));
}

    public function contact($id){
        // @todo
        
        $candidate_email = Candidate::where('id', $id)->first()->email;
        $mailInfo = [
            'title' => 'Mail from mzt.com',
            'body' => 'Welcome your contacting'
        ];       
        // send email
        Mail::to($candidate_email)->send(new \App\Mail\MztSendMail($mailInfo));	
        // Mail::to('developerh99@gmail.com')->send(new \App\Mail\MztSendMail($mailInfo));	

        // cost coins
        $wallet = Wallet::where('company_id', 1)->find(1);
        $coins = $wallet->coins;
        $coins = ($coins - 5) > 0 ? $coins - 5 : 0;
        $wallet->coins = $coins;
        $wallet->save();

        return response()->json([
            'message' => 'Mail has sent.',
            'coins' => $coins,
            'flag' => 1
        ], Response::HTTP_OK);
    }

    public function hire($id){
        // @todo
        // Your code goes here...

        // send mail
        $candidate_email = Candidate::where('id', $id)->first()->email;
        $mailInfo = [
            'title' => 'Mail from mzt.com',
            'body' => 'You are hired'
        ];

        Mail::to($candidate_email)->send(new \App\Mail\MztSendMail($mailInfo));	       

        $wallet = Wallet::where('company_id', 1)->find(1);
        $coins = $wallet->coins;
        $coins = ($coins + 5) > 20 ?  20 : $coins + 5;
        $wallet->coins = $coins;
        $wallet->save();

        return response()->json([
            'message' => 'Mail has sent.',
            'coins' => $coins,
            'flag' => 2
        ], Response::HTTP_OK);
    }
}
