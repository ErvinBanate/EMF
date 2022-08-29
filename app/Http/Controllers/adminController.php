<?php

namespace App\Http\Controllers;

use App\Models\Inventory;
use App\Models\User;
use App\Services\Inventory\InventoryService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class adminController extends Controller
{
    private $inventoryService;

    public function __construct(InventoryService $inventoryService)
    {
        $this->inventoryService = $inventoryService;
    }

    public function showUsers()
    {
        $role = Auth::user()->role->role_name;
        return view('employeeFolder.users', [
            'users' => User::all(),
            'role' => $role,
        ]);
    }

    public function createProduct(Request $request)
    {
        $this->inventoryService->createProduct($request);

        return redirect()->route('adminInventory');
    }

   public function addStock(Request $request)
    {
        $this->inventoryService->addStock($request);

        return redirect()->route('adminInventory');
    }

    public function removeStock(Request $request)
    {
        $this->inventoryService->removeStock($request);

        return redirect()->route('adminInventory');
    }

    public function removeProduct(Inventory $inventory_product)
    {
        $inventory_product->delete();

        return redirect()->route('adminInventory');
    }

    public function adminInventoryRequest()
    {
        
    }

    public function destroy($id)
    {
        //
    }
}
