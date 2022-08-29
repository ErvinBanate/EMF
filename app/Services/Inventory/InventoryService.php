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
            'stock' => $request->input('input-new-quantity'),
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
        $newAdditionalStock = (int)$request->input('input-add-quantity');
        $productStock = $product[0]->stock;

        // $dataType = gettype($productStock);
        // dd($dataType);
        $updatedStock = $productStock + $newAdditionalStock;

        DB::update('update inventories set stock = ? where product_name = ?', [$updatedStock, $productName]);
    }

    public function removeStock(Request $request)
    {
        $productName = $request->input('input-remove-product');
        $product = DB::select('select * from inventories where product_name = ?', [$productName]);
        $newRemoveStock = (int)$request->input('input-remove-quantity');
        $productStock = $product[0]->stock;

        // $dataType = gettype($productStock);
        // dd($dataType);
        $updatedStock = $productStock - $newRemoveStock;

        DB::update('update inventories set stock = ? where product_name = ?', [$updatedStock, $productName]);
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
}