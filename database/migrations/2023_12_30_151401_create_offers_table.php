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
        Schema::create('offers', function (Blueprint $table) {
            $table->string('id', 50);
            $table->text('url');
            $table->float('price');
            $table->float('oldprice');
            $table->string('currencyId',3);
            $table->integer('categoryID');
            $table->text('picture');
            $table->string('name', 150);
            $table->string('vendor',50);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('offers');
    }
};
