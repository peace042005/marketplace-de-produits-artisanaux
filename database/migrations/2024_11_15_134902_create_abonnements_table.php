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
        Schema::create('abonnements', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('restrict')->onUpdate('restrict');
            $table->foreignId('type_abonnement_id')->constrained('type_abonnements')->onDelete('restrict')->onUpdate('restrict');
            $table->timestamp('date_debut')->useCurrent();
            $table->date('date_fin');
            $table->addDefaultColumns();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('abonnements');
    }
};
