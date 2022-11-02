<?php

declare(strict_types = 1);

namespace App\Services\Inventory;

use App\Models\IncidentReport;
use App\Models\Inventory;
use App\Models\InventoryRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Svg\Tag\Rect;

class InventoryService
{
    private $inventory;
    private $inventoryRequest;

    public function __construct(Inventory $inventory, inventoryRequest $inventoryRequest)
    {
        $this->inventory = $inventory;
        $this->inventoryRequest = $inventoryRequest;
    }

    public function parseNewProduct(Request $request)
    {
        return [
            'product_name' => $request->input('input-new-product'),
            'total_stock' => $request->input('input-new-quantity'),
            'working_stock' => $request->input('input-new-quantity'),
            'product_type' => $request->input('input-new-product-type'),
        ];
    }

    public function createProduct(Request $request): void
    {
        $this->inventory->create($this->parseNewProduct($request));
    }

    public function getAllProducts()
    {
        return $this->inventory->all()->sortBy('product_name');
    }

    public function addStock(Request $request)
    {
        $productName = $request->input('input-add-product');
        $product = DB::select('select * from inventories where product_name = ?', [$productName]);
        $additionalStock = (int)$request->input('input-add-quantity');
        $totalStock = $product[0]->total_stock;
        $workingStock = $product[0]->working_stock;

        // $dataType = gettype($productStock);
        // dd($dataType);
        $updatedTotalStock = $totalStock + $additionalStock;
        $updatedWorkingStock = $workingStock + $additionalStock;
        // dd($updatedTotalStock, $updatedWorkingStock);

        DB::update('update inventories set total_stock = ?, working_stock = ? where product_name = ?', [$updatedTotalStock, $updatedWorkingStock, $productName]);
    }

    public function removeStock(Request $request)
    {
        $productName = $request->input('input-remove-product');
        $product = DB::select('select * from inventories where product_name = ?', [$productName]);
        $removedStock = (int)$request->input('input-remove-quantity');
        $workingStock = $product[0]->working_stock;
        $notWorkingStock = $product[0]->not_working_stock;

        // $dataType = gettype($productStock);
        // dd($dataType);
        $updatedWorkingStock = $workingStock - $removedStock;
        $updatedNotWorkingStock = $notWorkingStock + $removedStock;

        DB::update('update inventories set working_stock = ?, not_working_stock = ? where product_name = ?', [$updatedWorkingStock, $updatedNotWorkingStock, $productName]);
    }

    public function getAllRequests()
    {
        return $this->inventoryRequest->all()->sortBy('product_name');
    }

    public function parseNewProductRequest(Request $request)
    {
        return [
            'product_name' => $request->input('input-product'),
            'stock' => $request->input('input-quantity'),
            'product_type' => $request->input('input-product-type'),
            'requested_by' => $request->input('input-requested-by'),
        ];
    }

    public function createNewProductRequest(Request $request)
    {
        $this->inventoryRequest->create($this->parseNewProductRequest($request));
    }

    public function addStockByRequest($requested_product_name, $requested_quantity)
    {
        $product = $this->inventory->where(['product_name' => $requested_product_name, 'deleted_at' => null])->get();
        $updatedTotalStock = $product[0]->total_stock + $requested_quantity;
        $updatedWorkingStock = $product[0]->working_stock + $requested_quantity;

        DB::update('update inventories set total_stock = ?, working_stock = ? where id = ?', [$updatedTotalStock, $updatedWorkingStock, $product[0]->id]);
    }

    public function createNewProudctByRequest($product_request)
    {
        $data = [
            'product_name' => $product_request->product_name,
            'total_stock' => $product_request->stock,
            'working_stock' => $product_request->stock,
            'product_type' => $product_request->product_type,
        ];

        $this->inventory->create($data);
    }
}