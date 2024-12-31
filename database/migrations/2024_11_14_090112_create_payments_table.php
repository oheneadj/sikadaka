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
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->decimal('amount');
            $table->enum('payment_type', ['CONTRIBUTION', 'DONATION', 'DEBT']);
            $table->longText('purpose')->nullable();
            $table->string('month')->nullable();
            $table->integer('year')->nullable();
            $table->foreignId('contributor_id');
            $table->foreignId('user_id');
            $table->foreignId('project_id')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payments');
    }
};
