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
        Schema::create('tutor', function (Blueprint $table) {
            $table->increments("idT");
            $table->unsignedInteger("tutor_id");            
            $table->foreign("tutor_id")->references('id')->on('users')->onDelete('cascade');    
            $table->string('namaT')->nullable();
            $table->enum('jk',['Perempuan', 'Laki-Laki'])->nullable();
            $table->string('tgl_lahir')->nullable();
            $table->string("deskripsi")->nullable();
            $table->string("no_hp")->nullable();
            $table->string("alamat")->nullable();
            $table->string("r_pendidikan")->nullable();
            $table->text('foto')->nullable();
            $table->string('nilai_ijazah')->nullable();
            $table->text('berkas_ijazah')->nullable();
            $table->enum('status_akun',['Daftar','Acc','Block'])->nullable();
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
        Schema::dropIfExists('tutor');
    }
};
