<?php

namespace App\Http\Controllers;

use App\Models\Inventory;
use App\Models\ListOfExecutives;
use App\Models\Maintenance;
use App\Models\Role;
use App\Models\User;
use App\Services\Inventory\InventoryService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class adminController extends Controller
{
    private $inventoryService;
    private $listOfExecutives;
    private $maintenance;

    public function __construct(InventoryService $inventoryService, Maintenance $maintenance, ListOfExecutives $listOfExecutives)
    {
        $this->inventoryService = $inventoryService;
        $this->maintenance = $maintenance;
        $this->listOfExecutives = $listOfExecutives;
    }

    public function showUsers()
    {
        $role = Auth::user()->role->role_name;
        return view('employeeFolder.users', [
            'logo' => $this->maintenance->where(['id' => 1])->get(),
            'users' => User::all(),
            'role' => $role,
        ]);
    }

    public function account()
    {
        $role = Auth::user()->role->role_name;
        return view('employeeFolder.account', [
            'logo' => $this->maintenance->where(['id' => 1])->get(),
            'users' => User::all(),
            'role' => $role,
        ]);
    }

    public function editUser(User $user)
    {
        $role = Auth::user()->role->role_name;
        return view('employeeFolder.editUser', [
            'logo' => $this->maintenance->where(['id' => 1])->get(),
            'user' => $user,
            'role' => $role,
            'roles' => Role::all(),
        ]);
    }

    public function changePassword(User $user)
    {
        $role = Auth::user()->role->role_name;
        return view('employeeFolder.changePassword', [
            'logo' => $this->maintenance->where(['id' => 1])->get(),
            'role' => $role,
            'user' => $user,
        ]);
    }

    public function executivesMaintenance()
    {
        $role = Auth::user()->role->role_name;
        return view('employeeFolder.listOfExecutives', [
            'role' => $role,
            'logo' => $this->maintenance->where(['id' => 1])->get(),
            'executives' => $this->listOfExecutives->all(),
        ]);
    }

    public function editExecutive(ListOfExecutives $executive)
    {
        $role = Auth::user()->role->role_name;
        return view('employeeFolder.editExecutive', [
            'role' => $role,
            'logo' => $this->maintenance->where(['id' => 1])->get(),
            'executive' => $executive,
        ]);
    }

    public function updateExecutive(Request $request, ListOfExecutives $executive)
    {
        $request->validate([
            'name' => 'required | string',
        ]);
        $data = [
            'name' => $request['name'],
        ];

        $executive->update($data);

        return redirect()->route('executivesMaintenance');
    }

    public function logoMaintenance()
    {
        $role = Auth::user()->role->role_name;
        return view('employeeFolder.logoMaintenance', [
            'logo' => $this->maintenance->where(['id' => 1])->get(),
            'role' => $role,
        ]);
    }

    public function logInMaintenance()
    {
        $role = Auth::user()->role->role_name;
        return view('employeeFolder.logInMaintenance', [
            'logo' => $this->maintenance->where(['id' => 1])->get(),
            'backgroundImage' => $this->maintenance->where(['id' => 2])->get(),
            'role' => $role,
        ]);
    }

    public function logIn()
    {
        return view('auth.login', [
            'logo' => $this->maintenance->where(['id' => 1])->get(),
            'backgroundImage' => $this->maintenance->where(['id' => 2])->get(),
        ]);
    }

    public function uploadLogo(Request $request, Maintenance $logo_id)
    {
        $request->validate([
            'input-image' => 'mimes:jpg,png,jpeg,gif,svg | nullable',
        ]);
        if (isset($request['input-image'])) {
            // dd($request['input-image']);
            $imagePath = $request['input-image']->store('logo', 'public');
            $data = [
                'img_url' => $imagePath,
            ];
            $logo_id->update($data);
        }

        return redirect()->route('logoMaintenance');
    }

    public function uploadLogIn(Request $request, Maintenance $logIn_id)
    {
        $request->validate([
            'input-image' => 'mimes:jpg,png,jpeg,gif,svg | nullable',
        ]);
        if (isset($request['input-image'])) {
            // dd($request['input-image']);
            $imagePath = $request['input-image']->store('logo', 'public');
            $data = [
                'img_url' => $imagePath,
            ];
            $logIn_id->update($data);
        }

        return redirect()->route('logInMaintenance');
    }

    public function newPassword(User $user, Request $request)
    {
        $data = [
            'password' => Hash::make($request->input('password')),
        ];

        $user->update($data);

        return redirect()->route('account')->with('success', 'Account Password has been updated!');
    }

    public function updateUser(User $user, Request $request)
    {
        $data = [
            'name' => $request->input('name'),
            'email' => $request->input('email'),
        ];

        $user->update($data);

        return redirect()->route('account')->with('success', 'Account Details has been updated!');
    }

    public function createProduct(Request $request)
    {
        $this->inventoryService->createProduct($request);

        return redirect()->route('adminInventory')->with('success', 'Item has been Created!');
    }

   public function addStock(Request $request)
    {
        $this->inventoryService->addStock($request);

        return redirect()->route('adminInventory')->with('success', 'Additional Stock has been Added!');;
    }

    public function removeStock(Request $request)
    {
        $this->inventoryService->removeStock($request);

        return redirect()->route('adminInventory');
    }

    public function removeProduct(Inventory $inventory_product)
    {
        $inventory_product->delete();

        return redirect()->route('adminInventory')->with('success', 'Item has been Removed!');
    }

    public function searchInventory(Request $request) {
        if ($request->ajax()) {
            $output = "";
            $status = "";
            $actions = "";
            $items = $this->inventoryService->searchReports($request->search, $request->category);

            if ($items != []) {
                foreach ($items as $item) {
                    $output .= '<tr>'.
                    '<td>'. $item->product_name.'</td>'.
                    '<td>'. number_format($item->total_stock).'</td>'.
                    '<td>'. number_format($item->working_stock).'</td>'.
                    '<td>'. number_format($item->not_working_stock).'</td>'.
                    '<td>'. $item->product_type.'</td>'.
                    '<td class="text-center"><a href="{{ route("viewItemList",' . $item->id. ') }}">
                        <button class="btn btn-primary"><svg xmlns="http://www.w3.org/2000/svg"
                            width="16" height="16" fill="currentColor" class="bi bi-eye"
                            viewBox="0 0 16 16">
                            <path
                                d="M16 8s-3-5.5-8-5.5S0 8 0 8s3 5.5 8 5.5S16 8 16 8zM1.173 8a13.133 13.133 0 0 1 1.66-2.043C4.12 4.668 5.88 3.5 8 3.5c2.12 0 3.879 1.168 5.168 2.457A13.133 13.133 0 0 1 14.828 8c-.058.087-.122.183-.195.288-.335.48-.83 1.12-1.465 1.755C11.879 11.332 10.119 12.5 8 12.5c-2.12 0-3.879-1.168-5.168-2.457A13.134 13.134 0 0 1 1.172 8z" />
                            <path
                                d="M8 5.5a2.5 2.5 0 1 0 0 5 2.5 2.5 0 0 0 0-5zM4.5 8a3.5 3.5 0 1 1 7 0 3.5 3.5 0 0 1-7 0z" />
                        </svg></button></a>
                    </td>
                    </tr>';
                }
            }
        }
        return Response($output);
    }
}
