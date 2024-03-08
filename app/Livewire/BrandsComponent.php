<?php

namespace App\Livewire;

use App\Models\Brand;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;
use Livewire\WithPagination;


class BrandsComponent extends Component
{
    use WithPagination;
    use LivewireAlert;
    public $search='';
    public $Id, $name, $code, $abbrevation;

    protected $rules = [
        'name' => 'required|max:50',
        'code' => 'required|max:50',
        'abbrevation' => 'required|max:50'
    ];


    public function render()
    {
        $brands = Brand::where('name','like', '%'.$this->search.'%')->paginate(5);
        return view('livewire.brands-component', compact('brands'));
    }

    public function store(){
        $this->validate([
            'name' => 'required|max:50',
            'code' => 'required|max:50',
            'abbrevation' => 'required|max:50'
        ],[
            'abbrevation.required' => 'La abreviacion es requerida',
            'name.required' => 'El nombre es requerido',
            'code.required' => 'El nombre es requerido'
        ]);
        $brand = New Brand();
        $brand->name = $this -> name;
        $brand->code = $this -> code;
        $brand->abbrevation = $this ->abbrevation;
        $brand->save();
        $this->clear();
        $this->flash('success', 'Marca Creada');
        return redirect()->to('brand');
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
        $this->validate([
            'name' => 'required|max:50',
            'code' => 'required|max:50',
            'abbrevation' => 'required|max:50'
        ],[
            'abbrevation.required' => 'La abreviacion es requerida',
            'name.required' => 'El nombre es requerido',
            'code.required' => 'El nombre es requerido'
        ]);
        $brand = Brand::find($id);
        $brand->name = $this->name;
        $brand->code = $this -> code;
        $brand->abbrevation = $this ->abbrevation;
        $brand->save();
        $this->clear();
        $this->flash('success', 'Marca Modificada');
        return redirect()->to('brand');
    }
    
    public function delete($id){
        $brand = Brand::find($id);
        $brand->delete();
        $this->clear();
    }
}
