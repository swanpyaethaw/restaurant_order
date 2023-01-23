<?php

namespace App\Http\Livewire\Admin\Category;

use Livewire\Component;
use App\Models\Category;
use Livewire\WithPagination;
use Illuminate\Support\Facades\File;

class Index extends Component
{
    public $category_id;

    use WithPagination;
    protected $paginationTheme = 'bootstrap';


    public function destroyCategory($category_id){
        $this->category_id = $category_id;
        $category = Category::findOrFail($this->category_id);
        $category->receipes()->update([
            'category_id' => 1
        ]);
        if($category->image){
            if(File::exists($category->image)){
                File::delete($category->image);
            }
        }
        $category->delete();
        session()->flash('message','Category Deleted Successfully');
    }


    public function render()
    {
        $categories = Category::whereNot('id',1)->latest()->paginate(10);
        return view('livewire.admin.category.index',compact('categories'));
    }
}
