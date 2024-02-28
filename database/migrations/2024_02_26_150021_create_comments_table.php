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
        Schema::create('comments', function (Blueprint $table) {
            $table->id();
            $table->string('text');
            $table->unsignedInteger('sending_date');
            $table->unsignedInteger('publication_date');
            $table->enum('status', ['PENDING', 'PUBLISHED']);
            $table->unsignedBigInteger('content_id');
            $table->unsignedInteger('user_id');
            $table->timestamps();
            $table->string('created_by', 60);
            $table->string('updated_by', 60)->nullable();
            $table->foreign('content_id')->references('id')->on('contents');
            $table->foreign('user_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('comments');
    }
};
