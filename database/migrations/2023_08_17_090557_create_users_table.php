<?php

use App\Models\Base;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('users', function (Blueprint $table) {
            $length = Base::DEFAULT_STRING_LENGTH;
            
            $table->id();
            $table->uuid('uuid');
            $table->string('email', $length)->unique();
            $table->string('password', $length)->nullable();
            $table->boolean('html_email')->unsigned()->nullable()->default(0);
            $table->boolean('confirmed')->unsigned()->nullable()->default(0);
            $table->boolean('disabled')->unsigned()->nullable()->default(0);
            $table->boolean('blacklisted')->unsigned()->nullable()->default(0);
            $table->boolean('opted_in')->unsigned()->nullable()->default(0);
            $table->integer('bounce_count')->unsigned()->nullable()->default(0);
            $table->string('unique_id', $length)->nullable();
            $table->integer('subscribe_page')->unsigned()->nullable();
            $table->string('rss_frequency', 100)->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('subscribers');
    }
};
