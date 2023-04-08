<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| Web Create Controller
|--------------------------------------------------------------------------
|
| Create operations for web are handled from this controller.
|
*/

interface WebCreate 
{
    public function handleShippmentCreate(Request $request);
}

class WebCreateController extends Controller implements WebCreate
{
    /*
    |--------------------------------------------------------------------------
    | Handle Shippment Create
    |--------------------------------------------------------------------------
    */
    public function handleShippmentCreate(Request $request)
    {
        $validation = Validator::make($request->all(),[
            'sender_address_city' => ['nullable','string'],
            'reciever_address_city' => ['nullable','string'],
            'package_weight' => ['required','numeric'],
            'package_type' => ['nullable','string']
        ]);

        if ($validation->fails()) {
            return redirect()->back()->withErrors($validation)->withInput();
        }
        else {
            
        }
    }
}
