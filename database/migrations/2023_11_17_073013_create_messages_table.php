<?php

use App\Models\Base;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('messages', function (Blueprint $table) {
            $length = Base::DEFAULT_STRING_LENGTH;
            
            $table->id();
            $table->uuid('uuid');
            $table->string('subject', $length);
            $table->string('from_field', $length);
            $table->string('to_field', $length);
            $table->string('reply_to', $length);
            $table->longText('message')->nullable();
            $table->longText('text_message')->nullable();
            $table->text('footer')->nullable();
            $table->timestamp('embargo', 0)->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('messages');
    }
};
