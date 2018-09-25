<?php

namespace App\Model\Ares;

use App\Model\Ares\Product;

class ProductMapping extends Product
{
    public function suppliers()
    {
        return $this->belongsToMany('App\Model\Ares\SupplierMapping', 'supplier_product', 'product_id', 'supplier_id');
    }
}
