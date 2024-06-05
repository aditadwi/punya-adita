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
        Schema::create('detiltransaksis', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('transaksis_id')->unsigned();
            $table->bigInteger('kudapans_id')->unsigned();
            $table->integer('qty');
            $table->double('price');
            $table->timestamps();
        });

        Schema::table('detiltransaksis', function(Blueprint $table) {

         $table->foreign('transaksis_id')->references('id')->on('transaksis')
                ->onUpdate('cascade') ->onDelete('cascade');
               
           
     $table->foreign('kudapans_id')->references('id')->on('kudapans')
                ->onUpdate('cascade') ->onDelete('cascade');
        });
    }



    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('detiltransaksis', function(Blueprint $table) {
            $table->dropForeign('detiltransaksis_transaksis_id_foreign');
        });
   
        Schema::table('detiltransaksis', function(Blueprint $table) {
            $table->dropIndex('detiltransaksis_transaksis_id_foreign');
        });

        Schema::table('detiltransaksis', function(Blueprint $table) {
            $table->dropForeign('detiltransaksis_kudapans_id_foreign');
        });
   
        Schema::table('detiltransaksis', function(Blueprint $table) {
            $table->dropIndex('detiltransaksis_kudapans_id_foreign');
        });
       
        Schema::dropIfExists('detiltransaksis');

    }

};
