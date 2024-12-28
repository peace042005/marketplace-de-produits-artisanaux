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
        Schema::create('paiements', function (Blueprint $table) {
            $table->id();
            $table->timestamp('date_paiement')->useCurrent();
            $table->double('montant');
            $table->boolean('reussi')->default(false);
            $table->unsignedBigInteger('payable_id');
            $table->string('payable_type');
            $table->addDefaultColumns();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('paiements');
    }
};
