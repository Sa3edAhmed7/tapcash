<?php

namespace App\Http\Controllers\Api;

use App\Models\Child;
use App\Models\related_accounts;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Http\Resources\ChildResource;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;

class ChildController extends Controller
{
    use ApiResponseTrait;

    public function index()
    {
        $child = ChildResource::collection(Child::get());
        return $this->apiResponse($child,'ok',200);
    }


    public function show($id)
    {
        $child = Child::findorfail($id);
        if($child){
            return $this->apiResponse(new ChildResource($child),'ok',200);
        }
        return $this->apiResponse(null,'The Child Not Found',404);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'min:8|required_with:confirm_password|same:confirm_password',
            'confirm_password' => 'min:8',
            'phone' =>'required|numeric|digits:11',
            'national_id' =>'required|numeric|digits:14',
            'city' =>'required|string|max:20',
            'gender' =>'required|string|max:7',
            'age' =>'required|numeric|digits:2',
            
            
        ]);
        $account_number="4";
        for($i=0;$i<13;$i++){
        $account_number.=rand(0,9);
        }


        
        if($validator->fails())
        {
            return $this->apiResponse($validator->errors(),'failed',201);
        }

        $child= Child::create(array_merge(
            $validator->validated(),
        ['password' => Hash::make($request->password),
        'confirm_password' => Hash::make($request->confirm_password),
        'account_number'=>$account_number,
        'purchases_limit'=>$request->purchases_limit,
        'money_limit'=>$request->money_limit,
        'type'=>'3'
        ]
        ));
        
        $user = User::create(array_merge(
            $validator->validated(),
        ['password' => Hash::make($request->password),
        'confirm_password' => Hash::make($request->confirm_password),
        'account_number'=>$account_number,
        'type'=>'3'
        ]
        ));
        $mychild= new related_accounts();
        $mychild->parent_id = auth()->user()->id;
        $mychild->child_id = $child->id;
        $mychild->save();


        if($child){
            return $this->apiResponse($child,'The Child Save Success',201);
        }
        return $this->apiResponse(["empty"],'The Child Not Save',404);


    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(),[
            'name' => 'required|unique:children|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'min:8|required_with:confirm_password|same:confirm_password',
            'confirm_password' => 'min:8',
            'phone' =>'required|numeric|digits:11',
            'national_id' =>'required|numeric|digits:14',
            'city' =>'required|string|max:20',
            'type' =>'required|numeric|digits:1',
            'gender' =>'required|string|max:7',
            'age' =>'required|numeric|digits:2',
            'deposite' =>'required',
            'purchases_limit'=>'required',
            'money_limit'=>'required',
            'account_number' =>'required|numeric|digits:12',
        ]);

        if($validator->fails())
        {
            return $this->apiResponse(null,$validator->errors(),404);
        }

        $child= Child::find($id);

        if(!$child){
            return $this->apiResponse(null,'The Child Not Found',404);
        }

        $child->update($request->all());

        if($child){
            return $this->apiResponse(new ChildResource($child),'The Child Update Success',201);
        }
    }

    public function destroy($id)
    {
        $child= Child::find($id);

        if(!$child){
            return $this->apiResponse(null,'The Child Not Found',404);
        }

        $child->delete($id);

        if($child){
            return $this->apiResponse(new ChildResource($child),'The Child Delete Success',201);
        }
    }
}
