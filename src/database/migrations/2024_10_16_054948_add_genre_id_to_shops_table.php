<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddGenreIdToShopsTable extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::table('shops', function (Blueprint $table) {
      $table->unsignedBigInteger('genre_id')->nullable()->after('id');
      $table->foreign('genre_id')->references('id')->on('genres');
    });
  }

  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down()
  {
    Schema::table('shops', function (Blueprint $table) {
      $table->dropForeign(['genre_id']);
      $table->dropColumn('genre_id');
    });
  }
}
