<?php

namespace App\Http\Controllers;
use App\Models\Employee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{

    public function __construct()
    {
        // $this->middleware('auth');
    }

    public function login(Request $request)
    {
        $this->validate($request, [
            'username' => ['required'],
            'password' => ['required', 'min:6']
        ]);

        $username = $request->input('username');
        $password = $request->input('password');

        $employee = Employee::where('username', $username)->first();
        if (!$employee) {
            return response()->json(['message' => 'Login failed'], 401);
        }

        $isValidPassword = Hash::check($password, $employee->password);
        if (!$isValidPassword) {
          return response()->json(['message' => 'Login failed'], 401);
        }

        $generateToken = bin2hex(random_bytes(40));
        $employee->update([
            'token' => $generateToken
        ]);

        return response()->json([
          'message' => 'Login Success',
          'data' => $employee
        ], 200);
    }

    public function logout($id)
    {
        $loggedIn = Employee::whereId($id)->first();
        if($loggedIn['token'] = null)
        {
            return response()->json([
                'message' => 'Anda belum login'
            ]);
        }
        $loggedIn->update([
            'token' => null
        ]);

        return response()->json([
            'message' => 'Logout success'
        ], 200);

    }
}
