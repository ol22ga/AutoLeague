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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('article');
            $table->string('title');
            $table->text('description');
            $table->foreignIdFor(\App\Models\Manufacturer::class)->constrained()->cascadeOnUpdate();
            $table->string('complete_set');
            $table->string('material');
            $table->float('weight');
            $table->integer('count');
            $table->float('old_price');
            $table->float('new_price');
            $table->integer('buy')->default(0);
            $table->foreignIdFor(\App\Models\Category::class)->constrained()->cascadeOnUpdate();
            $table->foreignIdFor(\App\Models\Brand::class)->constrained()->cascadeOnUpdate();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
