<?php

namespace App\Http\Controllers\profile;

use App\Http\Controllers\Controller;
use App\Models\About;
use App\Models\Blog;
use App\Models\Business;
use App\Models\Category;
use App\Models\Education;
use App\Models\Experience;
use App\Models\Service;
use App\Models\Skill;
use App\Models\Testimonial;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $aboutMe = About::where('status' , 'ACTIVE')->first();
        $education = Education::where('status' , 'ACTIVE')->get();
        $experience = Experience::where('status' , 'ACTIVE')->get();
        $personal_skill = Skill::where('status' , 'ACTIVE')->where('type' , 'PERSONAL')->get();
        $software_skill = Skill::where('status' , 'ACTIVE')->where('type' , 'SOFTMARE')->get();
        $service = Service::where('status' , 'ACTIVE')->get();
        $testimonial = Testimonial::where('status' , 'ACTIVE')->get();
        $blog = Blog::where('status' , 'ACTIVE')->get();
        $category = Category::where('status' , 'ACTIVE')->get();
        $business = Business::where('status' , 'ACTIVE')->whereHas('category' , function($q){
            $q->where('status' , 'ACTIVE');
        })->with('category')->get();
        return view('profile.home.index' , compact('aboutMe' , 'education' , 'experience' ,
        'personal_skill' , 'software_skill' , 'service' , 'testimonial' , 'blog' ,
        'category' , 'business'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
