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
        Schema::create('vehicules', function (Blueprint $table) {
            $table->id();
            $table->string('numchassis')->unique();
            $table->string('matricule')->index();
            $table->string('matriculeWW')->nullable();
            $table->string('matriculeSTCR')->nullable();
            $table->string('marque')->nullable();
            $table->string('modele')->nullable();
            $table->string('type')->nullable();
            $table->integer('capacite')->nullable();
            $table->string('station_autorise1')->nullable();
            $table->string('station_autorise2')->nullable();
            $table->string('affectation')->nullable();
            $table->string('ville')->nullable();
            $table->string('societe', 100)->nullable();
            $table->string('usage', 100)->nullable();
            $table->date('dateMiseEnCirculation')->nullable();
            $table->string('pn_ps', 100)->nullable();
            $table->string('site', 100)->nullable();
            $table->boolean('active')->default(true);
            $table->string('type_desactive', 100)->nullable();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vehicules');
    }
};
