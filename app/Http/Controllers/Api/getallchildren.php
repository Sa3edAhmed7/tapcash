<?php

namespace App\Http\Controllers\Api;

use App\Models\child;
use App\Models\related_accounts;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class getallchildren extends Controller
{

    use ApiResponseTrait;
    public function index()
    {
        $user= Auth::user();
        
        $children_id=related_accounts::where('parent_id',$user->id)->get();
        $children_account=array();
        foreach($children_id as $child_id){
            array_push($children_account,child::where('id', $child_id->child_id)->first());
          }
        return $this->apiResponse($children_account,'my children',201);
      
    }
}
