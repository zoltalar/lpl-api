<?php

use App\Models\Base;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('admins', function (Blueprint $table) {
            $length = Base::DEFAULT_STRING_LENGTH;
            
            $table->id();
            $table->string('first_name', 100);
            $table->string('last_name', 100);
            $table->string('username', 100)->nullable();
            $table->string('email', $length)->unique();
            $table->string('phone', 20)->nullable();
            $table->string('password', 100);
            $table->boolean('active')->default(0)->nullable();
            $table->timestamps();
            
            $table->index(['first_name', 'last_name', 'username', 'email', 'phone']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('admins');
    }
};
