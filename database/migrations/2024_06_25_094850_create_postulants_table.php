<?php

use App\Models\Pays;
use App\Models\Recrutement;
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
        Schema::create('postulants', function (Blueprint $table) {
            $table->id();
            $table->string("prenom");
            $table->string("nom");
            $table->foreignIdFor(Pays::class);
            $table->foreignIdFor(Recrutement::class);
            $table->string("ville");
            $table->string("email");
            $table->string("phone");
            $table->string("whatsapp");
            $table->string("cv");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('postulants');
    }
};
