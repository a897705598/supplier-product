<?php

namespace App\Model\Ares;

use App\Model\Ares\Supplier;

class SupplierMapping extends Supplier
{
    public function products()
    {
        return $this->belongsToMany('App\Model\Ares\ProductMapping', 'supplier_product', 'supplier_id', 'product_id');
    }
}
