<?php

namespace App\Http\Controllers;


use App\Job;

use App\User;

use App\Http\Requests\SaveJobRequest; //imported
use App\Http\Requests\SaveProfileRequest; //imported


use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function indexLikedJobs()
    {

        $user = Auth::user();

        $data = ['user' => $user];

        return view('likedjobs')->with($data);
    }

    public function show()
    {
        return view('profile');
    }

    
    /**
     * Updat the user table uploading a file.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function uploadCV(SaveProfileRequest $request)
    {
    
              $file = $_FILES;  
              $name = time().$file['curriculum']['name'];
              move_uploaded_file( $_FILES["curriculum"]["tmp_name"], 'C:/laragon/www/Project/public/'. $name);

              $user = Auth::user();
              $userId = Auth::user()->id;
              $description = $request->description;
              $completed = $request->completed;

              
              $user->where('id', $userId)->update(array('description'=>$description, 'curriculum' => $name, 'completed'=>$completed));

              return redirect()->route('home')->with('status', 'Thank you '.$user->first_name .' for updating your profile.');

    }
}
