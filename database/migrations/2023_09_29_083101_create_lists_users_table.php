<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('lists_users', function (Blueprint $table) {
            $table->bigInteger('list_id')->unsigned();
            $table->bigInteger('user_id')->unsigned();
            
            $table->primary(['list_id', 'user_id']);
            
            $table->foreign('list_id')
                ->references('id')
                ->on('lists')
                ->onDelete('cascade')
                ->onUpdate('cascade');
            
            $table->foreign('user_id')
                ->references('id')
                ->on('users')
                ->onDelete('cascade')
                ->onUpdate('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('lists_users');
    }
};
