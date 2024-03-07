<?php

namespace Database\Seeders;

use App\Models\MeasurementUnit;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UnitsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $unit1= new MeasurementUnit;
        $unit1->name = 'Metro';
        $unit1->code = 'm';
        $unit1->save();

        $unit2= new MeasurementUnit;
        $unit2->name = 'Centimetro';
        $unit2->code = 'cm';
        $unit2->save();

        $unit3= new MeasurementUnit;
        $unit3->name = 'Pulgada';
        $unit3->code = 'in';
        $unit3->save();

        $unit4= new MeasurementUnit;
        $unit4->name = 'Pie';
        $unit4->code = 'ft';
        $unit4->save();

        $unit5= new MeasurementUnit;
        $unit5->name = 'Kilogramo';
        $unit5->code = 'kg';
        $unit5->save();

        $unit6= new MeasurementUnit;
        $unit6->name = 'Gramo';
        $unit6->code = 'g';
        $unit6->save();

        $unit7= new MeasurementUnit;
        $unit7->name = 'Litro';
        $unit7->code = 'l';
        $unit7->save();

        $unit8= new MeasurementUnit;
        $unit8->name = 'Mililitro';
        $unit8->code = 'ml';
        $unit8->save();
    }
}
