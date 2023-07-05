<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;
use App\Models\Drug;
use Illuminate\Support\Facades\Auth;
class DrugController extends Controller
{
     /**
     * Display the user's profile form.
     */
    public function create(): View
    {
        return view('applicant.create');
    }
    
    /**
     * Show.
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Validate the uploaded file
        $request->validate([
            'name' => 'required',
            'brand_name' => 'required',
            'description' => 'required',
            'image' => 'required' // Adjust the validation rules as per your requirements
        ]);
        $image = null;
        if (!empty($request->image)) {
            $file =$request->file('image');
            $extension = $file->getClientOriginalExtension(); 
            $filename = time().'.' . $extension;
            $file->move(public_path('uploads/'), $filename);
            $image = 'public/uploads/'.$filename;
        }
        $post = new Drug();
        $post->name = $request->name;
        $post->brand_name = $request->brand_name;
        $post->description = $request->description;
        $post->image = $image;
        $post->applicant_id = Auth::id();
        $post->manufacture_at = $request->manufacture_at;
        $post->expires_at = $request->expires_at;
        $post->save();
        
        return redirect()->back()->with('message', 'Your Application has been successfully registered.');
    }
    
    
    /**
    * Display the user's profile form.
    */
    public function review(): View
    {
        $unverified_drugs = Drug::where('status', '==', 0)
        ->get();
        return view("reviewer.review", compact("unverified_drugs"));
    }
    
    // /**
    // * Display the user's profile form.
    // */
    // public function show($id): View
    // {
    //     $details = Drug::where('id', '==', $id)
    //     ->first();
    //     return view("reviewer.details", compact("details"));
    // }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id): View
    {
        $drug = Drug::where('id', '=', $id)->first();
        return view('reviewer.edit',compact('drug'));
    }
    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $drug = Drug::where('id', '=', $id)->first();
        // Validate the uploaded file
        $request->validate([
            'name' => 'required',
            'brand_name' => 'required',
            'description' => 'required',
        ]);
        $data = $request->all();

        try {
            if (!empty($request->image)) {
                $file =$request->file('image');
                $extension = $file->getClientOriginalExtension(); 
                $filename = time().'.' . $extension;
                $file->move(public_path('uploads/'), $filename);
                $image = 'public/uploads/'.$filename;

                $data['image'] = $image;
            }
            if (!empty($request->status)) {
                //if rejected note must me provided
                if ($request->status == 2) {
                    $request->validate([
                        'note' => 'required',
                    ]);
                }
                else {
                    $data['verified_by'] = Auth::id();
                    $data['verifiyed_on'] = now()->format('Y-m-d H:i:s');
                }
                
            }
            $drug->update($data);
            return redirect()->back()->with('message', 'Drug has been successfully updated.');
        } catch (\Exception $e) {

            return $e->getMessage();
        }
    }
}
