<?php

namespace App\Http\Controllers;

use App\Services\UserAccessService;
use Illuminate\Http\Request;

class TestingController extends Controller
{
    public function index()
    {
        $userAccessService = new UserAccessService();
        $userAccessDetails = $userAccessService->getAccessModel('admin');
        $userAccessDetailsStatus = $userAccessService->isAccessAllowed('admin', 'users');
        return "test";
    }
}
