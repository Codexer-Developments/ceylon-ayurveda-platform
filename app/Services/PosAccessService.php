<?php

namespace App\Services;

use App\Models\Centers;
use App\Models\User;

class PosAccessService
{
    public function __construct()
    {
        // Constructor
    }

    public function posAccess($userId)
    {
        $centerDetails = Centers::where('owner_id', $userId)->get();
        if($centerDetails->count() > 0){
            return [
                'status' => true,
                'center_details' => $centerDetails,
            ];
        }else{
            $userDetails = User::where('id', $userId)->first();
            $centerDetails = Centers::all();

            if($userDetails->role == 'admin'){
                return [
                    'status' => true,
                    'center_details' => $centerDetails,
                ];
            }else{
                return [
                    'status' => false,
                    'center_details' => null,
                ];
            }
        }
    }

}
