<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use App\Models\User;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        $roleAdmin = Role::create(['name' => 'admin']);
        $roleTrabajador = Role::create(['name' => 'trabajador']);
        $user = User::find(1);
        $user->assignRole($roleAdmin);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
