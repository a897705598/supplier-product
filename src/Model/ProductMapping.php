<?php

namespace Jxc\Model\Basic;

use Jxc\Model\Basic\Product;

class ProductMapping extends Product
{
    public function suppliers()
    {
        return $this->belongsToMany('Jxc\Model\Basic\SupplierMapping', 'supplier_product', 'product_id', 'supplier_id');
    }
}
