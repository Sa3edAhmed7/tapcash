<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class UserDataController extends Controller
{
    use ApiResponseTrait;
    public function index()
    {
        // return $this->apiResponse()->json([
        //     'user' => auth()->user()
        // ]);
        $user= Auth::user();
        return $this->apiResponse($user,'user data' , 201);
    }
}
