<!DOCTYPE html>
<html lang="vi" class="h-full">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin') - TimeKeeper</title>

    @vite(['resources/css/admin/main.css',
    // 'resources/js/admin/main.js'
    ])
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

    @livewireStyles
    @stack('styles')
</head>

<body class="h-full bg-gray-900 text-gray-100">

    <div class="dashboard-container min-h-screen flex">

        <!-- Sidebar -->
        <x-admin.sidebar />

        <!-- Main Content -->
        <div class="main-content flex-1 flex flex-col">
            <!-- Topbar -->
            <x-admin.topbar />

            <!-- Page Content -->
            <main class="flex-1 p-6 overflow-y-auto">
                <div class="max-w-7xl mx-auto space-y-8">
                    @yield('content')
                </div>
            </main>
        </div>
    </div>

    @livewireScripts
    @stack('scripts')
</body>

</html>
