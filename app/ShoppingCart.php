<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ShoppingCart extends Model
{
  const BUY = 0;
  const BUDGET = 1;

  const BUY_URL = 'buys';
  const BUDGET_URL = 'budget';
}
