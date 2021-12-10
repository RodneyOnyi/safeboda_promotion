<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

use App\Models\PromoEvent;

class PromoCode extends Model
{
    use HasFactory;

    public function viewAll()
    {
        return PromoCode::join('promo_events', 'promo_events.id', '=', 'promo_codes.promo_event_id')
            ->select('promo_codes.id', 'promo_codes.name', 'promo_events.expiry_date')
            ->orderBy('id', 'asc')
            ->simplePaginate(10);
    }

    public function viewActive()
    {
        return PromoCode::join('promo_events', 'promo_events.id', '=', 'promo_codes.promo_event_id')
            ->select('promo_codes.id', 'promo_codes.name', 'promo_events.expiry_date')
            ->where('promo_codes.status', 1)
            ->orderBy('id', 'asc')
            ->simplePaginate(10);
    }

    public function generateCodes()
    {
        $promoEvent = PromoEvent::where('status', 2)->first();

        if ($promoEvent) {
            $promoCodes = PromoCode::count();
            for ($i = 0; $i < 10; $i++) {
                if ($promoCodes < $promoEvent->voucher_limit) {
                    $permitted_chars = '0123456789abcdefghijklmnopqrstuvwxyz';
                    $random = substr(str_shuffle($permitted_chars), 0, 5);

                    $request['promo_event_id'] = $promoEvent->id;
                    $request['name'] = $promoEvent->promo_code . $random;

                    $added = (new PromoCode)->add($request);
                    if ($added) {
                        $promoCodes++;
                    }
                } else if ($promoCodes == $promoEvent->voucher_limit) {
                    $promoEvent->status = 1;
                    $promoEvent->save();
                }
            }
        }
    }

    public function locationWithinRadius($point, $fenceArea)
    {
        $x = $point['lat'];
        $y = $point['lng'];

        $inside = false;
        for ($i = 0, $j = count($fenceArea) - 1; $i <  count($fenceArea); $j = $i++) {
            $xi = $fenceArea[$i]['lat'];
            $yi = $fenceArea[$i]['lng'];
            $xj = $fenceArea[$j]['lat'];
            $yj = $fenceArea[$j]['lng'];

            $intersect = (($yi > $y) != ($yj > $y))
                && ($x < ($xj - $xi) * ($y - $yi) / ($yj - $yi) + $xi);
            if ($intersect) $inside = !$inside;
        }

        return $inside;
    }

    public function validatePromo($request)
    {
        $promoCode = PromoCode::where('name', $request['promo_code'])
            ->join('promo_events', 'promo_events.id', '=', 'promo_codes.promo_event_id')
            ->where('expiry_date', '>=', date('Y-m-d'))
            ->first();

        if ($promoCode) {
            $fenceArea = (new PromoLocation)->view($promoCode->promo_event_id);

            $origin_coords = ["lat" => $request['lat_origin'], "lng" => $request['lng_origin']];
            $dest_coords = ["lat" => $request['lat_dest'], "lng" => $request['lng_dest']];

            $origin = (new PromoCode)->locationWithinRadius($origin_coords, $fenceArea);
            $dest = (new PromoCode)->locationWithinRadius($dest_coords, $fenceArea);

            if ($origin || $dest) {
                $url = 'https://maps.googleapis.com/maps/api/directions/json?origin=' . $request['lat_origin'] . ',' . $request['lng_origin'] . '&destination=' . $request['lat_dest'] . ',' . $request['lng_dest'] . '&key=' . env('GOOGLE_API');

                $route =  (new PromoCode)->GoogleAPI($url);

                return array(
                    'discount' => $promoCode->discount,
                    'min_spend' => $promoCode->min_spend,
                    'expiry' => $promoCode->expiry_date,
                    'route' => $route->routes[0]->legs ?? []
                );
            }
        }
        return false;
    }

    public function add($request)
    {
        $promoCode = new PromoCode;
        $promoCode->promo_event_id = $request['promo_event_id'];
        $promoCode->name = $request['name'];
        return $promoCode->save();
    }

    public function updatePromoCode($request)
    {
        $promoCode = (new PromoCode)->find($request['id']);
        $promoCode->status = 0;
        return $promoCode->save();
    }

    public function GoogleAPI($url)
    {
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_HTTPHEADER, array('Accept:application/json', 'Content-Type:application/json'));
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_CUSTOMREQUEST, 'GET');
        curl_setopt($curl, CURLOPT_HEADER, 0);
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt($curl, CURLOPT_CONNECTTIMEOUT, 0);
        curl_setopt($curl, CURLOPT_TIMEOUT, 600);
        $curl_response = curl_exec($curl);
        $httpcode = curl_getinfo($curl, CURLINFO_HTTP_CODE);

        if (curl_errno($curl)) {
            Log::info(curl_error($curl));
        }

        $request = new Request();
        $request->replace([
            'url' => $url,
            'http_code' => $httpcode,
            'payload' => '',
            'response' => $curl_response,
            'system' => 'GOOGLE_API'
        ]);
        (new SystemLog)->store($request);

        if ($httpcode == 200 || $httpcode == 201) {
            return json_decode($curl_response);
        }
        return null;
    }
}
