<?php

use App\Models\Base;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('categories', function (Blueprint $table) {
            $length = Base::DEFAULT_STRING_LENGTH;
            
            $table->increments('id');
            $table->string('name', $length)->unique();
            
            $table->index(['name']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('categories');
    }
};
