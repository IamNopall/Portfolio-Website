<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('admin_access', function (Blueprint $table) {
            $table->id();
            $table->string('key')->unique()->default('admin_pin');
            $table->string('pin_hash');
            $table->timestamp('last_login_at')->nullable();
            $table->string('last_login_ip')->nullable();
            $table->timestamps();
        });

        // Seed initial admin PIN from env or default, securely hashed with Bcrypt
        $initialPin = env('ADMIN_PIN', '20032005');
        DB::table('admin_access')->insert([
            'key' => 'admin_pin',
            'pin_hash' => Hash::make($initialPin),
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('admin_access');
    }
};
