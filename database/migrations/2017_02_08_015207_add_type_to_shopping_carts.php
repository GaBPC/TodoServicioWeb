<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddTypeToShoppingCarts extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::table('shopping_carts', function (Blueprint $table) {
        $table->integer('type')->after('quantity');
    });
  }

  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down()
  {
    Schema::table('shopping_carts', function (Blueprint $table) {
        $table->dropColumn('type');
    });
  }
}
