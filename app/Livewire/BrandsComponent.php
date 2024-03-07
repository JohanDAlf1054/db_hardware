<?php

namespace App\Livewire;

use App\Models\Brand;
use Livewire\Component;
use Livewire\WithPagination;

class BrandsComponent extends Component
{
    use WithPagination;
    public $search='';
    public $Id, $name, $code, $abbrevation;

    public function render()
    {
        // if ($this->search==""){
        //     $brands = Marca::paginate(6);
        //    }else{
        //        $brands = Marca::where('nombre','like', '%'.$this->search.'%')->get();
        //    }
        $brands = Brand::where('name','like', '%'.$this->search.'%')->paginate(5);
        return view('livewire.brands-component', compact('brands'));
    }

    public function store(){
        $brand = New Brand();
        $brand->name = $this -> name;
        $brand->code = $this -> code;
        $brand->abbrevation = $this ->abbrevation;
        $brand->save();
        $this->clear();
    }

    public function clear(){
        $this->name='';
        $this->code='';
        $this->abbrevation='';
    }

    public function edit($id){
        $brand = Brand::find($id);
        $this->clear();
        $this->Id = $brand->id;
        $this->name = $brand->name;
        $this->code = $brand->code;
        $this->abbrevation = $brand->abbrevation;
    }

    public function update($id){
        $brand = Brand::find($id);
        $brand->name = $this->name;
        $brand->code = $this -> code;
        $brand->abbrevation = $this ->abbrevation;
        $brand->save();
        $this->clear();
    }
    
    public function delete($id){
        $brand = Brand::find($id);
        $brand->delete();
        $this->clear();
    }
}
