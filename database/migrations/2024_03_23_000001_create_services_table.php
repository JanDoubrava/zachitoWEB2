<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        if (!Schema::hasTable('services')) {
            Schema::create('services', function (Blueprint $table) {
                $table->id();
                $table->string('name');
                $table->text('description');
                $table->decimal('price', 10, 2)->nullable();
                $table->string('image')->nullable();
                $table->boolean('is_active')->default(true);
                $table->timestamps();

                // Přidání indexů pro rychlejší vyhledávání
                $table->index('is_active');
                $table->index('created_at');
                $table->index('name');
            });
        }
    }

    public function down()
    {
        Schema::dropIfExists('services');
    }
}; 