<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PromoLocation extends Model
{
    use HasFactory;

    public function view($id)
    {
        return PromoLocation::select('id', 'lat', 'lng')
            ->where('promo_event_id', $id)
            ->where('status', 1)
            ->orderBy('id', 'asc')
            ->get();
    }

    public function add($request)
    {
        $location = new PromoLocation;
        $location->promo_event_id = $request['promo_event_id'];
        $location->lat = $request['lat'];
        $location->lng = $request['lng'];
        return $location->save();
    }

    public function updatelocation($request, $location)
    {
        $location->lat = $request['lat'];
        $location->lng = $request['lng'];
        $location->save();

        return $location;
    }

    public function deletelocation($request)
    {
        $location = PromoLocation::find($request['id']);
        $location->status = 0;
        $location->save();

        return $location;
    }
}
