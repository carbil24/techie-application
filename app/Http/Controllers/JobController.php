<?php

namespace App\Http\Controllers;

use App\Job;

use App\User;

use Illuminate\Support\Facades\DB;

use App\Http\Requests\SaveJobRequest; //imported

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;


class JobController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //$portfolio = Project::orderBy('created_at', 'DESC')->get();
        //$portfolio = Project::latest()->get();

        $jobs = Job::latest()->paginate();

        return view('jobs.index', compact('jobs'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (Auth::user()->email=='admin@techie.com')
            return view('jobs.create');
        else
        return redirect()->route('home');

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(SaveJobRequest $request)
    {
        /*$fields = request()->validate([
            'title' => 'required',
            'description' => 'required'
        ]);*/

        Job::create($request->validated());

        return redirect()->route('jobs.index')->with('status', 'The job as '.$job->title .' in '.$job->company .' has been added to the database.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Job $job)
    {
        //$project =  Project::findOrFail($id);

        return view('jobs.show', compact('job'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Job $job)
    {
        return view('jobs.edit', compact('job'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Job $job, SaveJobRequest $request)
    {
        $job->update($request->validated());


        return redirect()->route('jobs.index')->with('status', 'The job as '.$job->title .' in '.$job->company .' has been updated in the database.');
    }

    public function confirmDelete(Job $job)
    {
        
        return view('jobs.confirmDelete', compact('job'));
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Job $job)
    {
        
        //find all junction table entries with that job ID
        $junctions = DB::table('job_user')
        ->where('job_id', '=', $job->id)
        ->delete();

        $job->delete();
        
        return redirect()->route('jobs.index')->with('status', 'The job as '.$job->title .' in '.$job->company .' has been removed from the database.');
    }

    public function toggleLike($id){
 
        //get job from database
        $job = Job::Find($id);
        
        //get user (Auth) for now we use User 41
        $user = Auth::user();
        
        //check if it is already liked by the user
        $isLiked = $user->jobs()->where('id', $id)->exists();
        
        if($isLiked){
        //remove the like (delete entry)
        $user->jobs()->detach($id);
        return redirect()->back()->with('status', 'The job as '.$job->title .' in '.$job->company .' - '. $job->location . ' has been removed from your liked jobs.');

        }
        else{
        //add the like (create entry)
        $user->jobs()->attach($id);
        return redirect()->back()->with('status', 'The job as '.$job->title .' in '.$job->company .' - '. $job->location . ' has been added to your liked jobs.');

        }  
    }

    public function applyToJob(Job $job){
 
        return redirect()->back()->with('status', 'You have applied to the job as '.$job->title .' in '.$job->company .' - '. $job->location . '. The company will contact you soon!');
    }


    public function filter(Request $req){
        $location_input = strtolower($req->location);
        $keyword_input = strtolower($req->keywords);
        
        //replace all non alpha numeric characters with space
        // $str = preg_replace( '/[\W]/', ' ', $str);
        
        //words to be filtered out of search
        $common = ['a', 'an', 'and', 'the', 'or', 'to', 'that', 'for', 'on', 'where', 'in', 'this', 'while', 'is', ];
        
        //split strings into arrays
        $locations = preg_split('/\s+/', preg_replace( '/[\W]/', ' ', strtolower($req->location)));
        $keywords = preg_split('/\s+/', preg_replace( '/[\W]/', ' ', strtolower($req->keywords)));
        
        //filter out common words
        $locations = array_filter($locations, function($v) use ($common) {
        return ! in_array($v, $common);
        });
        
        //
        
        $keywords = array_filter($keywords, function($v) use ($common) 
        {
        return ! in_array($v, $common);
        });
        
        //check if arrays are empty. If so assign them null
        if(empty($keywords) || current($keywords) == ''){
        $keywords = null;
        }
        if(empty($locations) || current($locations) == ''){
        $locations = null;
        }
        
        //if theres no input from user, redirect to page
        if($locations == null && $keywords == null){
        return redirect('jobs');
        }
        
        //query with keywords only
        elseif($locations == null) {
        
        $jobs = Job::latest()
        ->where(function($query) use ($keywords){
        foreach($keywords as $key => $value){
        $query->where('title', 'like', '%' . $value . '%', 'or')
        ->orWhere('company', 'like', '%' . $value . '%', 'or')
        ->orWhere('location', 'like', '%' . $value . '%', 'or')
        ->orWhere('description', 'like', '%' . $value . '%', 'or');
        }
        })
        ->paginate();;
        
        }
        
        //query with location only
        elseif($keywords == null){
        
        $jobs = Job::latest()
        ->where(function($query) use ($locations){
        foreach($locations as $key => $value){
        $query->where('location', 'like', '%' . $value . '%', 'or');
        
        }
        })
        ->paginate();
        }
        
        //query locations and keywords
        else{
        
        $jobs = Job::latest()
        ->where(function($query) use ($locations){
            foreach($locations as $key => $value){
            $query->where('location', 'like', '%' . $value . '%', 'or');
            }
        })
        ->where(function($query) use ($keywords){
            foreach($keywords as $key => $value){
                $query->where('title', 'like', '%' . $value . '%', 'or')
                ->orWhere('company', 'like', '%' . $value . '%', 'or')
                ->orWhere('description', 'like', '%' . $value . '%', 'or');
            }
        })
        ->paginate();
        }
     

        return view('jobs.index', compact('jobs'));

    }        
}
