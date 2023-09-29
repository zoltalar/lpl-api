<?php

use App\Models\Base;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('lists', function (Blueprint $table) {
            $length = Base::DEFAULT_STRING_LENGTH;
            
            $table->id();
            $table->string('name', $length)->unique();
            $table->text('description')->nullable();
            $table->smallInteger('list_order')->unsigned()->nullable();
            $table->boolean('active')->default(0)->nullable();
            $table->smallInteger('category_id')->unsigned()->nullable();
            $table->timestamps();
            
            $table->foreign('category_id')
                ->references('id')
                ->on('categories')
                ->onDelete('set null')
                ->onUpdate('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('lists');
    }
};
