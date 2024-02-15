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
        Schema::create('chauffeurs', function (Blueprint $table) {
            $table->id();
            $table->string('nom');
            $table->string('prenom');
            $table->string('full_name')->virtualAs('concat(nom, \' \', prenom)');
            $table->integer('mat')->index();
            $table->string('tel')->nullable();
            $table->string('tel2')->nullable();
            $table->dateTime('dateNaissance')->nullable();
            $table->dateTime('dateEmbauche')->nullable();
            $table->dateTime('dateDepart')->nullable();
            $table->string('motifDepart')->nullable();
            $table->string('cin')->nullable();
            $table->string('adresse')->nullable();
            $table->string('villeAdresse')->nullable();
            $table->string('ville')->nullable();
            $table->string('affectation')->nullable();
            $table->string('centreFrais')->nullable();
            $table->boolean('active')->default(true);
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
        Schema::dropIfExists('chauffeurs');
    }
};
