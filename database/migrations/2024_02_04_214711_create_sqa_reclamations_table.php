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
        Schema::create('sqa_reclamations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('team_id')->constrained()->cascadeOnDelete();
            $table->foreignId('secteur_activite_id')->constrained()->cascadeOnDelete();
            $table->foreignId('client_id')->constrained()->cascadeOnDelete();
            $table->foreignId('flux_id')->constrained()->cascadeOnDelete();
            $table->foreignId('flux_type_id')->constrained()->cascadeOnDelete();
            $table->string('vehicule_matricule')->nullable();
            $table->integer('chauffeur_mat')->nullable();
            $table->time('horaire')->nullable();
            $table->set('mouvement', ['E', 'S'])->nullable();
            $table->text('detail')->nullable();
            $table->json('action_exploitation')->nullable()->constrained()->cascadeOnDelete();
            $table->date('date_a_echoir')->nullable();
            $table->unsignedBigInteger('moderateur_id')->nullable();
            $table->unsignedBigInteger('suiveur_id')->nullable();
            $table->boolean('cloture')->nullable()->default(false);
            $table->timestamps();
            $table->foreign('vehicule_matricule')
                ->references('matricule')
                ->on('vehicules')
                ->onDelete('cascade');
            $table->foreign('chauffeur_mat')
                ->references('mat')
                ->on('chauffeurs')
                ->onDelete('cascade');
            $table->foreign('moderateur_id')
                ->references('id')
                ->on('users')
                ->onDelete('cascade');
            $table->foreign('suiveur_id')
                ->references('id')
                ->on('users')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sqa_reclamations');
    }
};
