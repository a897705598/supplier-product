<?php

namespace Jxc\Controller;

use Illuminate\Contracts\Validation\Rule;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Jxc\Model\Basic\SupplierMapping;
use Jxc\Model\Basic\ProductMapping;
use App\Traits\ApiValidator;
use StructuredResponse\StructuredResponse;


class SupplierProductMappingController extends Controller
{
    use StructuredResponse, ApiValidator;

    public function productList()
    {
        $products = ProductMapping::with('suppliers')->get();
        Log::info($products);
        return view('product.productList')->with('products', $products);
    }

    public function supplierList()
    {
        $suppliers = SupplierMapping::with('products')->get();
        Log::info($suppliers);
        return view('supplier.supplierList')->with('suppliers', $suppliers);
    }

    public function getSuppliers(Request $request)
    {
        $this->validateApi($request, ['product_id'=>'required|exists:products']);
        $inputs = $request->all();
        $product_id = $inputs['product_id'];
        $suppliers = ProductMapping::with('suppliers')->where('product_id', '=', $product_id)->get()->toArray();
        Log::info($suppliers);
        if ($suppliers && $suppliers[0]['suppliers']) {
            $data = $suppliers[0]['suppliers'];
            Log::info($data);
            return $this->genResponse(1, '查询成功', $data);
        }
        return $this->genResponse(1, '不存在关联');
    }

    public function getProducts(Request $request)
    {
        $this->validateApi($request, [
            'supplier_id'=>'required|exists:suppliers'
        ]);
        $supplier_id = $request->get('supplier_id');
        $products = SupplierMapping::with('products')->where('supplier_id', '=', $supplier_id)->get()->toArray();
        Log::info($products);
        if ($products && $products[0]['products']) {
            $data = $products[0]['products'];
            Log::info($data);
            return $this->genResponse(1, '查询成功', $data);
        }
        return $this->genResponse(1, '不存在关联');    }

    public function bindSupplierProduct(Request $request)
    {
        $this->validateApi($request, [
            'product_id'=>['required', Rule::exists('products')->where(function ($query) {
                $query->where('deleted_at', null);
            })],
            'supplier_id'=>['required', Rule::exists('suppliers')->where(function ($query) {
                $query->where('deleted_at', null);
            })]
        ]);
        $product_id = $request->get('product_id');
        $supplier_id = $request->get('supplier_id');
        $record = DB::select('select * from supplier_product where product_id = ? and supplier_id = ?',
            [$product_id, $supplier_id]);
        if ($record) {
            Log::info('关联已存在');
            return $this->genResponse(1, '关联已存在');
        } else {
            $product = ProductMapping::find($product_id);
            $product->suppliers()->attach($supplier_id);
            Log::info('绑定关联');
            return $this->genResponse(1, '关联成功');
        }
    }
}
