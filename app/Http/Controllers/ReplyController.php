<?php

namespace App\Http\Controllers;

use App\Reply;
use App\Thread;
use Illuminate\Http\Request;

class ReplyController extends Controller
{

    /**
     * ReplyController constructor.
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function store(Request $request)
    {
        $this->validate($request,[
            'body'=>'required'
        ]);
        $thread = Thread::find($request['id']);
        $thread->add_reply([
           'user_id'=>auth()->id(),
           'body'=>$request['body']
        ]);
        return back();
    }
}
