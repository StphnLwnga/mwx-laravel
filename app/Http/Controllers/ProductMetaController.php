<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\BaseController as BaseController;
use App\Models\ProductMeta;

class ProductMetaController extends BaseController
{
  public function index() {
    $products = ProductMeta::all();

    return $this->sendResponse($products, 'Moworx product list retrieved successfully.');
    // return $products;
  }
}
