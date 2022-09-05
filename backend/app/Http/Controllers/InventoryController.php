<?php

namespace App\Http\Controllers;

use App\Models\Inventory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class InventoryController extends Controller
{

    public function __construct()
    {
        // $this->middleware('auth');
    }

    public function index()
    {
      $inventories = Inventory::all();

      return response()->json([
        'message' => 'Inventories List',
        'status' => 'success',
        'inventories' => $inventories
      ], 200);
    }

    public function show($id)
    {
      $inventory = Inventory::find($id);

      if(!$inventory){
        return response()->json([
          'message' => 'Data not found'
        ], 404);
      }

      return response()->json([
        'message' => 'Detail Inventory',
        'status' => 'success',
        'inventory' => $inventory
      ], 200);
    }
    
    public function create(Request $request)
    {

      $this->validate($request, [
        'name' => ['required'],
        'detail' => ['nullable'],
        'price' => ['numeric'],
        'location' => ['nullable'],
        'status' => ['nullable'],
      ]);

      Inventory::create([
        'name' => $request->input('name'),
        'detail' => $request->input('detail'),
        'price' => $request->input('price'),
        'location' => $request->input('location'),
        'status' => $request->input('status'),
      ]);

      return response()->json([
        'message' => 'Data added succesfully'
      ], 201);
    }

    public function update(Request $request, $id)
    {
      $inventory = Inventory::find($id);

      if(!$inventory){
        return response()->json([
          'message' => 'Data not found'
        ], 404);
      }

      $this->validate($request, [
        'name' => ['required'],
        'detail' => ['nullable'],
        'price' => ['numeric'],
        'location' => ['nullable'],
        'status' => ['nullable'],
      ]);

      $inventory->update([
        'name' => $request->input('name'),
        'detail' => $request->input('detail'),
        'price' => $request->input('price'),
        'location' => $request->input('location'),
        'status' => $request->input('status'),
      ]);

      return response()->json([
        'message' => 'Data Updated Successfully'
      ], 200);
    }

    public function delete($id)
    {
      $inventory = Inventory::find($id);
      $inventory->delete();

      return response()->json([
        'message' => 'Data deleted successfully'
      ]);

    }
}
