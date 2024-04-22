<?php

namespace App\Livewire;

use App\Models\MeasurementUnit;
use Illuminate\Support\Facades\Session;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;
use Livewire\WithPagination;

class UnitsComponent extends Component
{   
    use WithPagination;
    use LivewireAlert;
    public $search='';
    public $Id, $name, $code;

    protected $rules = [
        'code' => 'required|max:50',
        'name' => 'required|max:50'
    ];

    public function render()
    {
        $units = MeasurementUnit::where('name','like', '%'.$this->search.'%')->paginate(20);
        return view('livewire.units-component', compact('units'));
    }

    public function store(){
        $this->validate([
            'code' => 'required|max:50',
            'name' => 'required|max:50'
        ],[
            'code.required' => 'El codigo es requerido',
            'name.required' => 'El nombre es requerido'
        ]);
        
        $unit = New MeasurementUnit();
        $unit->name = $this -> name;
        $unit->code = $this -> code;
        $unit->save();
        $this->clear();
        Session::flash('notificacion', [
            'tipo' => 'exito',
            'titulo' => 'Éxito!',
            'descripcion' => 'Unidad Agregada!.',
            'autoCierre' => 'true'
        ]);
        return redirect()->to('units');
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
        $this->validate(
            [
                'code' => 'required|max:50',
                'name' => 'required|max:50'
            ],[
                'code.required' => 'El codigo es requerido',
                'name.required' => 'El nombre es requerido'
            ]
        );
        $unit = MeasurementUnit::find($id);
        $unit->name = $this->name;
        $unit->code = $this->code;
        $unit->save();
        $this->clear();
        Session::flash('notificacion', [
            'tipo' => 'error',
            'titulo' => 'Éxito!',
            'descripcion' => 'Unidad Modificada!.',
            'autoCierre' => 'true'
        ]);
        return redirect()->to('units');
    }
    
    public function delete($id){
        $unit = MeasurementUnit::find($id);
        $unit->delete();
        $this->clear();
    }
}
