<?php

namespace App\Livewire;

use App\Models\MeasurementUnit;
use App\Models\Unidade;
use Livewire\Component;
use Livewire\WithPagination;

class UnitsComponent extends Component
{
    use WithPagination;
    public $search='';
    public $Id, $name, $code;

    public function render()
    {
        // if ($this->search==""){
        //     $units = Unidade::paginate(6);
        //    }else{
        //        $units = Unidade::where('nombre','like', '%'.$this->criterio.'%')->get();
        //    }
           $units = MeasurementUnit::where('name','like', '%'.$this->search.'%')->paginate(5);
        return view('livewire.units-component', compact('units'));
    }

    public function store(){
        $unit = New MeasurementUnit();
        $unit->name = $this -> name;
        $unit->code = $this -> code;
        $unit->save();
        $this->clear();
    }

    public function clear(){
        $this->name='';
        $this->code='';
    }

    public function edit($id){
        $unit = MeasurementUnit::find($id);
        $this->clear();
        $this->Id = $unit->id;
        $this->name = $unit->name;
        $this->code = $unit->code;
    }

    public function update($id){
        $unit = MeasurementUnit::find($id);
        $unit->name = $this->name;
        $unit->code = $this->code;
        $unit->save();
        $this->clear();
    }
    
    public function delete($id){
        $unit = MeasurementUnit::find($id);
        $unit->delete();
        $this->clear();
    }
}
