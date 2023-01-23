<?php

namespace App\Http\Livewire\Admin\Table;

use App\Models\Table;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    Use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public $table,$table_no,$tableId;

    protected $rules = [
        'table_no' => 'required'
    ];

    public function addTable(){
        $validated = $this->validate();

        $this->table = new Table;
        $this->table->table_no = $validated['table_no'];
        $this->table->save();
        $this->resetInput();
        session()->flash('message','Table Created Successfully');
        $this->dispatchBrowserEvent('close-modal');
    }

    public function editTable($tableId){
        $this->tableId = $tableId;
        $this->table = Table::find($tableId);
        $this->table_no = $this->table->table_no;
    }

    public function updateTable(){
        $validated = $this->validate();
        $this->table =  Table::find($this->table->id);
        $this->table->table_no = $validated['table_no'];
        $this->table->save();
        $this->resetInput();
        session()->flash('message','Table Updated Successfully');
        $this->dispatchBrowserEvent('close-modal');
    }

    public function deleteTable($tableId){
        $this->table =  Table::find($tableId);
        $this->table->delete();
        session()->flash('message','Table Deleted Successfully');
    }

    public function resetInput(){
        $this->table_no = '';
        $this->resetErrorBag();
    }

    public function render()
    {
        $tables = Table::paginate(10);
        return view('livewire.admin.table.index',['tables' => $tables])
                ->extends('layouts.admin')
                ->section('content');
    }
}
