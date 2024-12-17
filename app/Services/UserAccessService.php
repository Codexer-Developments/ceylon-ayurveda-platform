<?php

namespace App\Services;

class UserAccessService
{
    public function __construct()
    {
        // Constructor
    }

    public function getAccessModel($userRoleString)
    {
      $getAccessDataJson = file_get_contents(public_path('base/acess_data.json'));
      $getAccessDataJson = json_decode($getAccessDataJson,true);
      return $getAccessDataJson[$userRoleString]['access'];
    }

    public function isAccessAllowed($userRoleString, $accessString)
    {
        $getAccessDataModels = $this->getAccessModel($userRoleString);
        return in_array($accessString, $getAccessDataModels);
    }
}
