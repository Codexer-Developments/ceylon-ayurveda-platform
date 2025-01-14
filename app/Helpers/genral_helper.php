<?php

if (!function_exists('getCenters')) {
    function getCenters($userDetails)
    {
        $getCenter = \App\Models\Centers::where('owner_id', $userDetails->id)->get();
        if($getCenter->count() > 0){
            return $getCenter->pluck( 'id')->toArray();
        }else{
            if($userDetails->role == 'admin'){
                $getCenter = \App\Models\Centers::all();
                return $getCenter->pluck( 'id')->toArray();
            }else{
                return [];
            }

        }
    }
}
