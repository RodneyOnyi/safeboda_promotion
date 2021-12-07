<?php

namespace App\Http\Controllers;

use App\Models\PromoCode;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PromoCodeController extends Controller
{

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:api');
    }

    /**
     * Display the specified resource.
     *
     * @param  Request  $request
     * @return \Illuminate\Http\Response
     */
    public function promo(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'promo_code' => 'required',
            'lat_origin' => 'required|numeric',
            'lng_origin' => 'required|numeric',
            'lat_dest' => 'required|numeric',
            'lng_dest' => 'required|numeric',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $validPromo = (new PromoCode)->validatePromo($request);

        if ($validPromo) {
            return response()->json([
                'status' => 'success',
                'message' => "Your promotion code is valid for " . $validPromo['discount_percentage'] . "%",
                'data' => $validPromo
            ]);
        } else {
            return response()->json([
                'status' => 'error',
                'message' => 'Your promotion code is not valid or has expired',
            ], 500);
        }
    }

    public function list()
    {
        return (new PromoCode)->viewAll();
    }

    public function activeList()
    {
        return (new PromoCode)->viewActive();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function deactivate(Request $request)
    {

        $promoCodeUpdate = (new PromoCode)->updatePromoCode($request);

        if ($promoCodeUpdate) {
            return response()->json([
                'status' => 'success',
                'message' => "PromoCode successfully deactivated.",
            ]);
        } else {
            return response()->json([
                'status' => 'error',
                'message' => 'PromoCode was not deactivated.',
            ], 500);
        }
    }
}
