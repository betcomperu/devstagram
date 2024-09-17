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
       Schema::table('posts', function (Blueprint $table) {
           $table->integer('likes_count')->default(0); // Agregar la columna likes_count
       });
   }

   public function down()
   {
       Schema::table('posts', function (Blueprint $table) {
           $table->dropColumn('likes_count'); // Eliminar la columna en caso de rollback
       });
   }
};
