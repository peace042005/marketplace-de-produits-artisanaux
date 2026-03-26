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
        Schema::create('commandes', function (Blueprint $table) {
            $table->id();
        // ID du client qui a passé la commande
        $table->foreignId('user_id')->constrained('users')->onDelete('restrict')->onUpdate('restrict');

        // ID de l'artisan qui a reçu la commande
        $table->foreignId('artisan_id')->constrained('users')->onDelete('restrict')->onUpdate('restrict');
        $table->timestamp('date_commande')->useCurrent();
            $table->double('total');
            $table->boolean('statut')->default(false);
            $table->addDefaultColumns();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('commandes');
    }
};
