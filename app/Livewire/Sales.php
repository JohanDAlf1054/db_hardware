<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Sale;
use Livewire\WithPagination;

class Sales extends Component
{
    use WithPagination;
    public $id,$criterio, $dates, $bill_numbers, $sellers, $payments_methods, $observations ,$discounts_total ,$gross_totals,$taxes_total, $net_total, $values_total;
    public function render()
    {
        if ($this->criterio==""){
        $sales = Sale::paginate(2);
    } else {
        $sales = Sale::where('sellers', 'like', '%' . $this->criterio . '%')->paginate(2);
    }

        return view('livewire.sales', compact('sales'));
    }


public function store(){
    $sale = New Sale();
    $sale->dates = $this->dates;
    $sale->bill_numbers = $this->bill_numbers;
    $sale->sellers = $this->sellers;
    $sale->payments_methods = $this->payments_methods;
    $sale->observations = $this->observations;
    $sale->discounts_total = $this->discounts_total;
    $sale->gross_totals = $this->gross_totals;
    $sale->taxes_total = $this->taxes_total;
    $sale->net_total = $this->net_total;
    $sale->values_total = $this->values_total;
    $sale->save();
    $this->limpiarCampos();
}
public function limpiarCampos(){
    $this-> dates = '';
    $this-> bill_numbers = '';
    $this-> sellers = '';
    $this-> payments_methods = '';
    $this-> observations = '';
    $this-> discounts_total = '';
    $this-> gross_totals = '';
    $this-> taxes_total = '';
    $this-> net_total = '';
    $this-> values_total = '';
}

public function editar($id){
    $sale = Sale::find($id);
    $this-> id = $sale -> id;
    $this-> dates = $sale -> dates;
    $this-> bill_numbers = $sale -> bill_numbers;
    $this-> sellers = $sale -> sellers;
    $this-> payments_methods = $sale -> payments_methods;
    $this-> observations = $sale -> observations;
    $this-> discounts_total = $sale -> discounts_total;
    $this-> gross_totals = $sale -> gross_totals;
    $this-> taxes_total = $sale -> taxes_total;
    $this-> net_total = $sale -> net_total;
    $this-> values_total = $sale -> values_total;
}

public function update($id){
    $sale = Sale::find($id);
    $sale->dates = $this->dates;
    $sale->bill_numbers = $this->bill_numbers;
    $sale->sellers = $this->sellers;
    $sale->payments_methods = $this->payments_methods;
    $sale->observations = $this->observations;
    $sale->discounts_total = $this->discounts_total;
    $sale->gross_totals = $this->gross_totals;
    $sale->taxes_total = $this->taxes_total;
    $sale->net_total = $this->net_total;
    $sale->values_total = $this->values_total;
    $sale->save();
    $this->limpiarCampos();
}

public function borrar($id){
    $sale = Sale::find($id);
    $sale->delete();
    $this->limpiarCampos();
}


}
