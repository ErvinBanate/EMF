<?php

namespace App\Http\Controllers;

use App\Models\Inventory;
use App\Models\Role;
use App\Models\User;
use App\Services\Inventory\InventoryService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

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

    public function editUser(User $user)
    {
        return view('employeeFolder.editUser', [
            'user' => $user,
            'roles' => Role::all(),
        ]);
    }

    public function changePassword(User $user)
    {
        return view('employeeFolder.changePassword', [
            'user' => $user,
        ]);
    }

    public function newPassword(User $user, Request $request)
    {
        $data = [
            'password' => Hash::make($request->input('password')),
        ];

        $user->update($data);

        return redirect()->route('users');
    }

    public function updateUser(User $user, Request $request)
    {
        $data = [
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'role_id' => $request->input('role_id'),
        ];

        $user->update($data);

        return redirect()->route('users');
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
}
