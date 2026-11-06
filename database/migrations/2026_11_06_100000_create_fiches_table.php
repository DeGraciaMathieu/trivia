<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('fiches', function (Blueprint $table) {
            $table->id();
            $table->string('slug')->unique();
            $table->string('terme');
            $table->string('categorie')->index();
            $table->string('date_libelle');
            $table->string('teaser', 170);
            $table->string('retenir');
            $table->text('aujourdhui');
            // Exactement trois paragraphes : le gabarit est porté par la structure,
            // pas par une consigne. Voir CreerFicheTool::schema().
            $table->text('recit_1');
            $table->text('recit_2');
            $table->text('recit_3');
            $table->unsignedInteger('ordre')->unique();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('fiches');
    }
};
