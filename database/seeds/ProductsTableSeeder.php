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
    for ($i=0; $i < 15; $i++) {
      DB::table('products')->insert([
        'name' => 'Producto '.$i,
        'price' => rand(0,1000),
        'image' => null,
        'category_id' => rand(1,15),
        'created_at' => DB::raw('CURRENT_TIMESTAMP'),
        'updated_at' => DB::raw('CURRENT_TIMESTAMP'),
      ]);
    }
  }
}
