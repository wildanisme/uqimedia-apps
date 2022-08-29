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
      $employees = Inventory::all();

      return response()->json([
        'message' => 'Inventories List',
        'data' => $employees
      ], 200);
    }

    public function show($id)
    {
      $inventory = Inventory::whereId($id)->first();

      return response()->json([
        'message' => 'Data Inventory by ID',
        'data' => $inventory
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

    public function delete($id)
    {
      $inventory = Inventory::whereId($id)->first();
      $inventory->delete();

      return response()->json([
        'message' => 'Data deleted successfully'
      ]);

    }
}
