<?php

namespace App\Http\Controllers;

use App\Models\Employee;

class InventoryController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
      $employees = Employee::all();

      return response()->json([
        'message' => 'Employees List',
        'data' => $employees
      ], 200);
    }

    //
}
