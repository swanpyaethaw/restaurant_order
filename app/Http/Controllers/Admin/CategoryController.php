<?php

namespace App\Http\Controllers\Admin;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.categories.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.categories.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string',
            'description' => 'required|string',
            'image' => 'nullable|image|mimes:png,jpg,jpeg'
        ]);

        $category = new Category();
        $category->name = $validated['name'];
        $category->description = $validated['description'];

        if($request->hasFile('image')){
            $file = $request->file('image');
            $ext = $file->getClientOriginalExtension();
            $fileName = uniqid() . "." . $ext;
            $file->move('uploads/category',$fileName);
            $validated['image'] = "uploads/category/$fileName";
            $category->image = $validated['image'];
        }
        $category->save();
        return redirect('admin/categories')->with('message','Category Created Successfully');
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
    public function edit(Category $category)
    {
        return view('admin.categories.edit',compact('category'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,Category $category)
    {
        $validated = $request->validate([
            'name' => 'required|string',
            'description' => 'required|string',
            'image' => 'nullable|image|mimes:png,jpg,jpeg'
        ]);

        $category->name = $validated['name'];
        $category->description = $validated['description'];

        if($request->hasFile('image')){
            if(File::exists($category->image)){
                File::delete($category->image);
            }
            $file = $request->file('image');
            $ext = $file->getClientOriginalExtension();
            $fileName = uniqid() . "." . $ext;
            $file->move('uploads/category',$fileName);
            $validated['image'] = "uploads/category/$fileName";
            $category->image = $validated['image'];
        }
        $category->save();
        return redirect('admin/categories')->with('message','Category Updated Successfully');

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

    public function deleteCategoryImage(Category $category)
    {
        if($category->image){
            if(File::exists($category->image)){
                File::delete($category->image);
            }
        }
        $category->image = null;
        $category->save();
        return redirect('admin/categories/'.$category->id.'/edit')->with('message','Category Image Deleted Successfully');
    }
}
