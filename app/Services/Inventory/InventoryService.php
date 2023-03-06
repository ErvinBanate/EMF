<?php

declare(strict_types = 1);

namespace App\Services\Inventory;

use App\Models\IncidentReport;
use App\Models\Inventory;
use App\Models\InventoryRequest;
use App\Models\ItemList;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Svg\Tag\Rect;

class InventoryService
{
    private $inventory;
    private $itemList;
    private $inventoryRequest;

    public function __construct(Inventory $inventory, inventoryRequest $inventoryRequest, ItemList $itemList)
    {
        $this->inventory = $inventory;
        $this->itemList = $itemList;
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
        $request->validate([
            'input-new-product' => 'required | string',
            'input-new-quantity' => 'required | integer',
            'input-new-accounted' => 'required | string',
            'input-new-acquired' => 'required | date',
            'input-new-expiration' => 'nullable | date | after: input-new-acquired',
        ]);
        $parseData = $this->parseNewProduct($request);
        $acronym = "";
        $items = $this->getAllProducts();
        $present = 0;
        foreach ($items as $item) {
            if ($item->product_name == $parseData['product_name']) {
                $present = 1;
            }
        }
        if ($present == 0) {
            $strings = explode(" ", $parseData['product_name']);
            foreach ($strings as $word) {
                $acronym .= mb_substr($word, 0, 1);
            }
            $parseData += ['item_acronym' => $acronym];
            $this->inventory->create($parseData);
            for ($quantity = 1; $quantity <= $parseData['total_stock']; $quantity++ ) {
                $data = [
                    'item_number' => $acronym . "-" . $quantity,
                    'acronym' => $acronym,
                    'status' => 'working',
                    'aquired_date' => $request->input('input-new-acquired'),
                    'expiration_date' => $request->input('input-new-expiration'),
                    'person_accounted' => $request->input('input-new-accounted'),
                    'item_type' => $parseData['product_type'],
                ];
                // dd($data);
                $this->itemList->create($data);
            }
        }
    }

    public function getAllProducts()
    {
        return $this->inventory->all()->sortBy('product_name');
    }

    public function getAllRequestProducts()
    {
        return $this->inventoryRequest->all()->sortBy('product_name');
    }

    public function getAllItemList()
    {
        return $this->itemList->all()->sortBy('id');
    }

    public function addStock(Request $request)
    {
        $request->validate([
            'input-add-product' => 'required | string',
            'input-add-quantity' => 'required | integer',
            'input-add-accounted' => 'required | string',
            'input-add-acquired' => 'required | date | before: input-add-expiration',
            'input-add-expiration' => 'nullable | date | after: input-add-acquired',
        ]);
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

        for ($quantity = $totalStock + 1; $quantity <= $totalStock + $additionalStock; $quantity++) {
            $data = [
                'item_number' => $product[0]->item_acronym . "-" . $quantity,
                'acronym' => $product[0]->item_acronym,
                'status' => 'working',
                'aquired_date' => $request->input('input-add-acquired'),
                'expiration_date' => $request->input('input-add-expiration'),
                'person_accounted' => $request->input('input-add-accounted'),
                'item_type' => $product[0]->product_type,
            ];

            DB::update('update inventories set total_stock = ?, working_stock = ? where product_name = ?', [$updatedTotalStock, $updatedWorkingStock, $productName]);
            $this->itemList->create($data);
        }
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
        if ($updatedWorkingStock >= 0) {
            $updatedNotWorkingStock = $notWorkingStock + $removedStock;
            DB::update('update inventories set working_stock = ?, not_working_stock = ? where product_name = ?', [$updatedWorkingStock, $updatedNotWorkingStock, $productName]);
        }
    }

    public function parseNewProductRequest(Request $request)
    {
        return [
            'product_name' => $request->input('input-product'),
            'stock' => $request->input('input-quantity'),
            'product_type' => $request->input('input-product-type'),
            'requested_by' => $request->input('input-requested-by'),
            'aquired_date' => $request->input('input-aquired'),
            'expiration_date' => $request->input('input-expiration'),
        ];
    }

    public function createNewProductRequest(Request $request)
    {
        $parseData = $this->parseNewProductRequest($request);
        
        $this->inventoryRequest->create($parseData);
    }

    public function addStockByRequest($request)
    {
        $product = $this->inventory->where(['product_name' => $request->product_name, 'deleted_at' => null])->get();
        $updatedTotalStock = $product[0]->total_stock + $request->stock;
        $updatedWorkingStock = $product[0]->working_stock + $request->stock;

        DB::update('update inventories set total_stock = ?, working_stock = ? where id = ?', [$updatedTotalStock, $updatedWorkingStock, $product[0]->id]);
        for ($quantity = $product[0]->total_stock; $quantity <= $product[0]->total_stock + $request->stock; $quantity++) {
            $data = [
                'item_number' => $product[0]->item_acronym . "-" . $quantity,
                'acronym' => $product[0]->item_acronym,
                'status' => 'working',
                'aquired_date' => $request->aquired_date,
                'expiration_date' => $request->expiration_date,
                'person_accounted' => $request->requested_by,
                'item_type' => $product[0]->product_type,
            ];

            $this->itemList->create($data);
        }
    }

    public function createNewProudctByRequest($product_request)
    {
        $data = [
            'product_name' => $product_request->product_name,
            'total_stock' => $product_request->stock,
            'working_stock' => $product_request->stock,
            'product_type' => $product_request->product_type,
        ];
        $acronym = "";
        $strings = explode(" ", $product_request['product_name']);
        foreach ($strings as $word) {
            $acronym .= mb_substr($word, 0, 1);
        }
        $data += ['item_acronym' => $acronym];
        $this->inventory->create($data);
        for ($quantity = 1; $quantity <= $data['total_stock']; $quantity++ ) {
            $itemData = [
                'item_number' => $acronym . "-" . $quantity,
                'acronym' => $acronym,
                'status' => 'working',
                'aquired_date' => $product_request->aquired_date,
                'expiration_date' => $product_request->expiration_date,
                'person_accounted' => $product_request->requested_by,
                'item_type' => $data['product_type'],
            ];

            $this->itemList->create($itemData);
        }
    }

    public function searchReports($search, $category) 
    {
        $resultReport = array();
        $searchStr = '%'.$search.'%';

        $resultReport = $this->inventory->where($category,'LIKE',$searchStr)->get()->sortBy('product_name');

        return $resultReport;
    }

    public function getItems($status, $acronym)
    {
        return $this->itemList->where(['status' => $status, 'acronym' => $acronym])->get()->sortBy('item_number');
    }
}