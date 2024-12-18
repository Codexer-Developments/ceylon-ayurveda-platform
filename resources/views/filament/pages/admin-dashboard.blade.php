<x-filament-panels::page>
    <div class="filament-page">
        <header class="filament-header">
            <p class="filament-header-subtitle">Manage your application's resources effectively.</p>
        </header>

        <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-4 gap-6">
            <!-- Example Widget 1 -->
            <div class="bg-white shadow rounded-lg p-4">
                <h2 class="text-lg font-bold">Users</h2>
                <p class="mt-2 text-3xl font-semibold text-gray-900">{{ $this->totalUsers }}</p>
                <p class="mt-1 text-sm text-gray-500">Total registered users</p>
            </div>

            <!-- Example Widget 2 -->
            <div class="bg-white shadow rounded-lg p-4">
                <h2 class="text-lg font-bold">Products</h2>
                <p class="mt-2 text-3xl font-semibold text-gray-900">{{$this->totalProducts}}</p>
                <p class="mt-1 text-sm text-gray-500">Total Products</p>
            </div>

            <!-- Example Widget 3 -->
            <div class="bg-white shadow rounded-lg p-4">
                <h2 class="text-lg font-bold">Centers</h2>
                <p class="mt-2 text-3xl font-semibold text-gray-900">{{$this->totalProducts}}</p>
                <p class="mt-1 text-sm text-gray-500">Total Centers</p>
            </div>

            <!-- Example Widget 4 -->
            <div class="bg-white shadow rounded-lg p-4">
                <h2 class="text-lg font-bold">Products</h2>
                <p class="mt-2 text-3xl font-semibold text-gray-900">789</p>
                <p class="mt-1 text-sm text-gray-500">Active products</p>
            </div>
        </div>

        <div class="mt-8">
            <h2 class="text-xl font-bold">Recent Activities</h2>
            <div class="bg-white shadow rounded-lg mt-4 p-6">
                <ul class="divide-y divide-gray-200">
                    <li class="py-4">
                        <div class="flex justify-between">
                            <span>User John Doe updated their profile</span>
                            <span class="text-sm text-gray-500">2 hours ago</span>
                        </div>
                    </li>
                    <li class="py-4">
                        <div class="flex justify-between">
                            <span>Order #1234 was completed</span>
                            <span class="text-sm text-gray-500">5 hours ago</span>
                        </div>
                    </li>
                    <li class="py-4">
                        <div class="flex justify-between">
                            <span>New product added: "Laravel Mastery"</span>
                            <span class="text-sm text-gray-500">1 day ago</span>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </div>

</x-filament-panels::page>
