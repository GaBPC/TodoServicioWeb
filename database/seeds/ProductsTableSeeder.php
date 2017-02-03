<?php

use Illuminate\Database\Seeder;

class ProductsTableSeeder extends Seeder
{
  /**
  * Run the database seeds.
  *
  * @return void
  */
  public function run()
  {
    DB::table('products')->insert([
      'name' => 'Martillo ',
      'price' => 45,
      'image' => null,
      'category_id' => 1,
      'created_at' => DB::raw('CURRENT_TIMESTAMP'),
      'updated_at' => DB::raw('CURRENT_TIMESTAMP'),
    ]);
  }
}
