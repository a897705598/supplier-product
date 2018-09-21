<?php
Route::group(['namespace'=>'Jxc\Controller'], function () {
    Route::post('product/bindSupplier', ['uses'=>'SupplierProductMappingController@bindSupplierProduct']);
    Route::get('product/productList', ['uses'=>'SupplierProductMappingController@productList']);
    Route::get('supplier/supplierList', ['uses'=>'SupplierProductMappingController@supplierList']);
});
