<?php

namespace App;

trait ResourceAccessTrait
{
    public static $checkPermissionBasedOnClass = false;
    public static function shouldRegisterNavigation(): bool
    {
        $model = self::class;
        $parts = explode("\\", $model); // Split by backslash
        $getModelName = end($parts); // Get the last part
        $getUserAccessService = new \App\Services\UserAccessService();
        return $getUserAccessService->isAccessAllowed(auth()->user()->role, $getModelName);
    }
}
