<?php

use Illuminate\Database\Seeder;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      DB::table('categories')->insert([
        'category_name' => 'Categoria básica',
        'created_at' => DB::raw('CURRENT_TIMESTAMP'),
        'updated_at' => DB::raw('CURRENT_TIMESTAMP'),
      ]);

      DB::table('categories')->insert([
        'category_name' => 'Ferretería',
        'created_at' => DB::raw('CURRENT_TIMESTAMP'),
        'updated_at' => DB::raw('CURRENT_TIMESTAMP'),
      ]);

      DB::table('categories')->insert([
        'category_name' => 'Pinturería',
        'created_at' => DB::raw('CURRENT_TIMESTAMP'),
        'updated_at' => DB::raw('CURRENT_TIMESTAMP'),
      ]);

      DB::table('categories')->insert([
        'category_name' => 'Electrónica',
        'created_at' => DB::raw('CURRENT_TIMESTAMP'),
        'updated_at' => DB::raw('CURRENT_TIMESTAMP'),
      ]);
    }
}
