<?php

namespace App\Http\Controllers\Admin;

use App\Models\Receipe;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use App\Http\Requests\ReceipeFormRequest;
use App\Models\ReceipeImage;

class ReceipeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $receipes = Receipe::when($request->category != null,function($q) use ($request){
                        return $q->where('category_id',$request->category);
                    })
                    ->orderBy('id','desc')
                    ->paginate(10);
        $categories = Category::all();
        return view('admin.receipes.index',compact('receipes','categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
        return view('admin.receipes.create',compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ReceipeFormRequest $request)
    {
        $validated = $request->validated();

        $receipe = new Receipe;
        $receipe->name = $validated['name'];
        $receipe->category_id = $validated['category_id'];
        $receipe->description = $validated['description'];
        $receipe->price = $validated['price'];
        $receipe->save();

        $receipe = Receipe::findOrFail($receipe->id);
        foreach($request->file('images') as $file){
            $ext = $file->getClientOriginalExtension();
            $fileName = uniqid() . '.' . $ext;
            $file->move('uploads/receipes',$fileName);
            $fileFullName = 'uploads/receipes/' . $fileName;
            $receipe->images()->create([
                'image' => $fileFullName
            ]);
        }

        return redirect('admin/receipes')->with('message','Receipe Created Successfully');
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
    public function edit(Receipe $receipe)
    {
        $categories = Category::all();
        return view('admin.receipes.edit',compact('receipe','categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,Receipe $receipe)
    {
        $validated = $request->validate([
            'name' => 'required|string',
            'category_id' => 'required|integer',
            'description' => 'required|string',
            'price' => 'required|numeric',
            'images.*' => 'image|mimes:png,jpg,jpeg'
        ]);

        $receipe->name = $validated['name'];
        $receipe->category_id = $validated['category_id'];
        $receipe->description = $validated['description'];
        $receipe->price = $validated['price'];
        if($request->file('images')){
            foreach($request->file('images') as $file){
                $ext = $file->getClientOriginalExtension();
                $fileName = uniqid() . '.' . $ext;
                $file->move('uploads/receipes',$fileName);
                $fileFullName = 'uploads/receipes/' . $fileName;
                $receipe->images()->create([
                    'image' => $fileFullName
                ]);
            }
        }

        $receipe->save();
        return redirect('admin/receipes')->with('message','Receipe Updated Successfully');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Receipe $receipe)
    {
        if($receipe->images){
            foreach($receipe->images as $image){
                if(File::exists($image)){
                    File::delete($image);
                }
            }
        }
        $receipe->delete();
        return redirect('admin/receipes')->with('message','Receipe Deleted Successfully');

    }

    public function deleteReceipeImage(ReceipeImage $receipeImage){
        if(File::exists($receipeImage->image)){
            File::delete($receipeImage->image);
        }
        $receipeImage->delete();
        return back()->with('message','Receipe Image Deleted Successfully');
    }
}
