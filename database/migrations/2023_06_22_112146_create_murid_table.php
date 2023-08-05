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
        Schema::create('murid', function (Blueprint $table) {
            $table->increments("idM");
            $table->unsignedInteger("murid_id");            
            $table->foreign("murid_id")->references('id')->on('users')->onDelete('cascade'); 
            $table->string('namaM')->nullable();
            $table->enum('jk',['Perempuan', 'Laki-Laki'])->nullable();
            $table->string('tgl_lahir')->nullable();
            $table->string("deskripsi")->nullable();
            $table->string("no_hp")->nullable();
            $table->string("alamat")->nullable();
            $table->string("r_pendidikan")->nullable();
            $table->string("kurikulum")->nullable();
            $table->text('foto')->nullable();
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
        Schema::dropIfExists('murid');
    }
};
