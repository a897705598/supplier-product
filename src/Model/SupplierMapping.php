<?php

namespace Jxc\Model\Basic;

use Jxc\Model\Basic\Supplier;

class SupplierMapping extends Supplier
{
    public function products()
    {
        return $this->belongsToMany('Jxc\Model\Basic\ProductMapping', 'supplier_product', 'supplier_id', 'product_id');
    }
}
