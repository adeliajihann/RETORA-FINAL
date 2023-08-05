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
        Schema::create('rating', function (Blueprint $table) {
            $table->increments("id");
            $table->unsignedInteger("t_id");            
            $table->foreign("t_id")->references('idT')->on('tutor')->onDelete('cascade'); 
            $table->unsignedInteger("m_id");            
            $table->foreign("m_id")->references('idM')->on('murid')->onDelete('cascade'); 
            $table->unsignedInteger("les_id");            
            $table->foreign("les_id")->references('id')->on('les')->onDelete('cascade'); 
            $table->unsignedInteger("id_detail");            
            $table->foreign("id_detail")->references('id')->on('detail_les')->onDelete('cascade'); 
            $table->double("rating", 3, 1);
            $table->text("ulasan");
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
        Schema::dropIfExists('rating');
    }
};
