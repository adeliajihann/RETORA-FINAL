<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('detail_les', function (Blueprint $table) {
            $table->increments("id");
            $table->unsignedInteger("id_les");
            $table->foreign("id_les")->references('id')->on('les')->onDelete('cascade');   
            $table->unsignedInteger("tutor")->nullable(); 
            $table->foreign("tutor")->references('idT')->on('tutor')->onDelete('cascade'); 
            $table->unsignedInteger("id_murid")->nullable(); 
            $table->foreign("id_murid")->references('idM')->on('murid')->onDelete('cascade'); 
            $table->string('tgl_awal');            
            $table->string('tgl_akhir')->nullable();      
            $table->enum("status", ['diterima', 'ditolak', 'pending','selesai'])->nullable();      
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('detail_les');
    }
};
