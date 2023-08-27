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

       // if (Schema::hasColumn('contacts', 'country_id'))
        //    return;

        // Add the foreign key constraint
         // or 'CASCADE' if desired
        Schema::table('contacts', function (Blueprint $table) {
            $table->foreign('country_id')->references('id')->on('countries')->onDelete('SET NULL');
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        /*if (! Schema::hasColumn('contacts', 'country_id')) {
            return;
        }

        Schema::table('contacts', function(Blueprint $table) {
            $table->dropForeign(['country_id']);
            $table->dropColumn('country_id');
        });*/
    }
};
