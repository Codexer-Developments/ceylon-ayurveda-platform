<?php

namespace App\Filament\Pages;

use App\Filament\Resources\UserResource\Widgets\TotalUsersWidget;
use Filament\Pages\Page;
use App\Models\User;
use App\Models\Products;
use App\Models\Centers;

class AdminDashboard extends Page
{
    protected static ?string $navigationIcon = 'heroicon-o-document-text';

    protected static string $view = 'filament.pages.admin-dashboard';

    public function mount()
    {
        // Pass data to the page if needed
        $this->totalUsers = User::where('role','manager')->count();
        $this->totalProducts = Products::where('status', 1)->count();
        $this->totalCenters = Centers::where('status', 1)->count();
    }

}
