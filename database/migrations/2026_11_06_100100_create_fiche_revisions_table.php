<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Il n'y a pas d'étape de relecture : une fiche écrite par le MCP est
     * publiée aussitôt. L'historique est donc le seul moyen de voir ce qui a
     * changé et de revenir en arrière. Une ligne est écrite avant chaque
     * modification et avant chaque suppression.
     */
    public function up(): void
    {
        Schema::create('fiche_revisions', function (Blueprint $table) {
            $table->id();
            $table->string('slug')->index();
            $table->json('avant');
            $table->string('operation'); // modification | suppression
            $table->string('auteur')->nullable();
            $table->timestamp('created_at');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('fiche_revisions');
    }
};
