<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\Employee;

class EmployeeController extends Controller
{

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

    public function create(Request $request)
    {
      $this->validate($request, [
        'name' => ['required', 'max:32'],
        'username' => ['required', 'max:16'],
        'password' => ['required', 'min:6']
      ]);

      $name = $request->input('name');
      $username = $request->input('username');
      $password = Hash::make($request->input('password'));

      $employee = Employee::create([
        'name' => $name,
        'username' => $username,
        'password' => $password,
      ]);

      return response()->json([
        'message' => 'Data added succesfully'
      ], 201);
    }

    public function update(Request $request, $id)
    {
      $employee = Employee::whereId($id);

      if(!$employee){
        return response()->json([
          'message' => 'Data not found',
        ], 404);
      }

      $this->validate($request, [
        'name' => ['required', 'max:32'],
        'username' => ['required', 'max:16'],
        'password' => ['required', 'min:6']
      ]);

      $employee->update([
        'name' => $request->input('name'),
        'username' => $request->input('username'),
        'password' => $request->input('password'),
      ]);

      return response()->json([
        'message' => 'Data updated successfully'
      ], 201);
      
    }
}
