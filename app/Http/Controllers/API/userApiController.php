<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class userApiController extends Controller
{
    function login(Request $request)
    {
        try {
            $this->validate($request, [
                'email' => 'required|email',
                'password' => 'required',
            ]);
            if (auth()->attempt(['email' => $request->input('email'), 'password' => $request->input('password')])) {
                $user = auth()->user();
                $data['api_token'] = $user->api_token;
                $data['name'] = $user->name;
                return $this->sendResponse($data, 'User retrieved successfully', 200);
            } else {
                return $this->sendError('invalid data', 422);
            }
        } catch (\Exception $e) {
            return $this->sendError($e->getMessage(), 500);
        }
    }
    function register(Request $request)
    {
        $data = array();
        try {
            $validate = $this->validateData($request);
            if ($validate->fails())
                return $this->sendError($validate->messages(), 422);
            $user = new User;
            $user->name = $request->input('name');
            $user->email = $request->input('email');
            $user->password = Hash::make($request->input('password'));
            $user->api_token = Str::random(60);
            $data['name'] = $user->name;
            $data['api_token'] = $user->api_token;
            $user->save();
        } catch (\Exception $e) {
            return $this->sendError($e->getMessage(), 500);
        }
        return $this->sendResponse($data, 'User retrieved successfully', 200);
    }

    public function validateData($request)
    {
        return Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|unique:users',
            'password' => 'required',
        ], [
            'name.required' => 'name is required',
            'email.required' => 'email is required',
            'name.unique' => 'name is already exist',
            'password.required' => 'password is required',
        ]);
    }
}
