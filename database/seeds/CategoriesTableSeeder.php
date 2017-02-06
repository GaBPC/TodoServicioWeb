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

    $names = array(
      "Categoría básica", "Sanitarios", "Línea Hogar", "Ferretería", "Gas",
      "Pinturería", "Repuestos"
    );
    foreach ($names as $name) {
      DB::table('categories')->insert([
        'category_name' => $name,
        'created_at' => DB::raw('CURRENT_TIMESTAMP'),
        'updated_at' => DB::raw('CURRENT_TIMESTAMP'),
      ]);
    }

  }
}
