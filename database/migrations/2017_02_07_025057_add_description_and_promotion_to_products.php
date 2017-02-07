<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddDescriptionAndPromotionToProducts extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::table('products', function (Blueprint $table) {
          $table->boolean('promo')->after('units')->default(false);
          $table->text('description')->after('name')->nullable();
      });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
      Schema::table('products', function (Blueprint $table) {
          $table->dropColumn('promo');
          $table->dropColumn('description');
      });
    }
}
