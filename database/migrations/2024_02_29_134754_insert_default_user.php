<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Hash;

use App\Models\User;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        $user = new User();

        $user->name     = "Usuario Prex";
        $user->email    = "prexuser@prex.com.ar";
        $user->password = "12345654321"; 

        $user->save();
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        User::where('email', 'prexuser@prex.com.ar')->first()->delete();
    }
};
