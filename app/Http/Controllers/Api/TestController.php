<?php

namespace App\Http\Controllers\Api;

use App\Thread;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TestController extends Controller
{
    public function threads(){
        $threads = Thread::all();
        return response()->json(['success'=>true,'message'=>'Threads fetched successfully','data'=>$threads],200);
    }
    public function create_thread(Request $request){
        $thread = Thread::create($request->all());
        return response()->json(['success'=>true,'message'=>'Thread Created Successfully','data'=>$thread]);
    }
}
