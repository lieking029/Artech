<?php

use App\Models\Category;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\Art;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('categories', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->timestamps();
        });

        Category::insert([
            ['name' => 'Realism'],
            ['name' => 'Impressionism'],
            ['name' => 'Expressionism'],
            ['name' => 'Abstract Art'],
            ['name' => 'Cubism'],
            ['name' => 'Surrealism'],
            ['name' => 'Pop Art'],
            ['name' => 'Minimalism'],
            ['name' => 'Fauvism'],
            ['name' => 'Renaissance Art'],
            ['name' => 'Baroque Art'],
            ['name' => 'Romanticism'],
            ['name' => 'Modernism'],
            ['name' => 'Contemporary Art'],
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('categories');
    }
};
