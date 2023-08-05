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
        Schema::create('les', function (Blueprint $table) {
            $table->increments("id");            
            $table->unsignedInteger("id_user");            
            $table->foreign("id_user")->references('id')->on('users')->onDelete('cascade');                         
            $table->unsignedInteger("id_tutor");            
            $table->foreign("id_tutor")->references('idT')->on('tutor')->onDelete('cascade');                         
            $table->enum("jenis_paket",["Paket Pagi","Paket Siang","Paket Sore","Paket Malam"]); 
            $table->string("kurikulum")->nullable();
            $table->string("mapel"); 
            $table->string("pendidikan");
            $table->string("kelas");
            $table->string("harga");        
            $table->string('jadwal');
            $table->string("rps");
            $table->enum("status_paket",["Publikasi","Sembunyikan"]);
            $table->enum("kondisi",["penuh","kosong"]);
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
        Schema::dropIfExists('les');
    }
};
