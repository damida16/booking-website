<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('products', function (Blueprint $table) {
            // Remove the `status` field
            $table->dropColumn('status');

            // Add new fields
            $table->boolean('isAvailable')->default(true); // Default is available
            $table->string('kategori')->nullable(); // Optional category field
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('products', function (Blueprint $table) {
            // Add the `status` field back
            $table->string('status')->nullable();

            // Remove the new fields
            $table->dropColumn('isAvailable');
            $table->dropColumn('kategori');
        });
    }
};
