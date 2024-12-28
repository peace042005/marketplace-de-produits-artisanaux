<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Database\Schema\Blueprint;

class MigrationServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        // Ajoute la méthode `addDefaultColumns` à Blueprint
        Blueprint::macro('addDefaultColumns', function () {
            $this->timestamps(); // Ajoute created_at et updated_at
            $this->softDeletes(); // Ajoute deleted_at

            // Ajoute les colonnes pour l'utilisateur
            $this->foreignId('created_by')->nullable()->constrained('users');
            $this->foreignId('updated_by')->nullable()->constrained('users');
            $this->foreignId('deleted_by')->nullable()->constrained('users');
        });
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
