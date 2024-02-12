<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\OutsideMessage;
use Illuminate\Http\Request;

class OutsideMessageController extends Controller
{
    public function showMessages(){
        $messages=OutsideMessage::all();
        return view('admin.outside-messages.index',compact('messages'));
    }

    public function destroy(OutsideMessage $message)
    {
        $message->delete();
        return redirect()->back()->with('success', 'Message has been deleted.');
    }


}
