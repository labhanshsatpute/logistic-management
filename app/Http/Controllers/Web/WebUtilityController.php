<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

/*
|--------------------------------------------------------------------------
| Web Utility Controller
|--------------------------------------------------------------------------
|
| Utility operations for web are handled from this controller.
|
*/

interface WebUtility 
{
    public static function handleCalculateShippmentBill(Request $request);
}

class WebUtilityController extends Controller implements WebUtility
{
    /*
    |--------------------------------------------------------------------------
    | Handle Calculate Bill
    |--------------------------------------------------------------------------
    */
    public static function handleCalculateShippmentBill(Request $request)
    {
        $validation = Validator::make($request->all(),[
            'sender_address_city' => ['nullable','string'],
            'reciever_address_city' => ['nullable','string'],
            'package_weight' => ['required','numeric'],
            'package_type' => ['nullable','string']
        ]);

        if ($validation->fails()) {
            return response(['status' => false, 'error' => $validation->messages()], 500);
        }
        else {

            $total = 0;

            $tax_percentage = 18;

            $delivery_charges = 0;

            if ($request->input('package_weight') <= 1) {
                $delivery_charges = $request->input('package_weight') * 170;
            }
            elseif ($request->input('package_weight') <= 3) {
                $delivery_charges = $request->input('package_weight') * 160;
            }
            elseif ($request->input('package_weight') <= 5) {
                $delivery_charges = $request->input('package_weight') * 140;
            }
            elseif ($request->input('package_weight') <= 10) {
                $delivery_charges = $request->input('package_weight') * 130;
            }
            elseif ($request->input('package_weight') <= 15) {
                $delivery_charges = $request->input('package_weight') * 115;
            }
            elseif ($request->input('package_weight') <= 20) {
                $delivery_charges = $request->input('package_weight') * 105;
            }
            else {
                $delivery_charges = $request->input('package_weight') * 90;
            }
            
            switch ($request->input('package_type')) {
                case 'Food & Vegetable':
                    $delivery_charges += 50;
                    break;
                case 'Handle With Care':
                    $delivery_charges += 70;
                    break;
                case 'Vaccine':
                    $delivery_charges += 100;
                    break;
                case 'Medicine':
                    $delivery_charges += 30;
                    break;
            }

            $total += $delivery_charges;

            $tax = ($total * $tax_percentage) / 100;
            $total += $tax;

            if ($request->ajax()) {
                return response(['status' => true, 'data' => [
                    'delivery_charges' => number_format($delivery_charges,2),
                    'tax' => number_format($tax,2),
                    'total' => number_format($total,2),
                ]],200);
            }
            else {
                return [
                    'delivery_charges' => (float)$delivery_charges,
                    'tax' => (float)$tax,
                    'total' => (float)$total,
                ];
            }
            
        }
    }
}
