<?php

namespace App\Http\Controllers;

use App\Models\Inventory;

class InventoryController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
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
    

    public function create()
    {
      
    }
}
