<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
{
    Schema::create('posts', function (Blueprint $table) {
        $table->id();
        $table->string('title', 50);                                   // varchar(50), not null
        $table->text('content');                                       // text
        $table->foreignId('user_id')->constrained()->cascadeOnDelete();       // int FK -> users
        $table->foreignId('category_id')->constrained()->cascadeOnDelete();   // int FK -> categories
        $table->enum('is_active', ['Yes', 'No'])->default('Yes');
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('posts');
    }
};
