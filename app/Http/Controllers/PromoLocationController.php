<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\PromoLocation;

class PromoLocationController extends Controller
{ 
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'promo_event_id' => 'required|numeric|gt:0',
            'lat' => 'required|numeric',
            'lng' => 'required|numeric',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $location = (new PromoLocation)->add($request);

        if ($location) {
            return response()->json([
                'status' => 'success',
                'message' => 'Location has been successfully added.',
            ]);
        } else {
            return response()->json([
                'status' => 'error',
                'message' => 'Location has not been added.',
            ], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function deleteLocation(Request $request)
    {
        $promoLocationUpdate = (new PromoLocation)->deletelocation($request);

        if ($promoLocationUpdate) {
            return response()->json([
                'status' => 'success',
                'message' => "PromoLocation successfully deleted.",
            ]);
        } else {
            return response()->json([
                'status' => 'error',
                'message' => 'PromoLocation was not deleted.',
            ], 500);
        }
    }
}
