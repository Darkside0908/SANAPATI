<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title', 'SANAPATI - Sistem Akuntabilitas dan Navigasi Kinerja Siber-Sandi Terintegrasi')</title>
    
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800;1,400&display=swap" rel="stylesheet">
    
    <!-- Scripts & Styles -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    @stack('styles')
</head>
<body class="circuit-bg min-h-screen">
    <!-- Navbar -->
    @include('components.navbar')
    
    <!-- Main Content -->
    <main>
        @yield('content')
    </main>
    
    <!-- Footer -->
    <footer class="py-8 mt-16 border-t border-cyan-900/30">
        <div class="container mx-auto px-4 text-center text-gray-400">
            <p>&copy; {{ date('Y') }} BSSN - Badan Siber dan Sandi Negara</p>
            <p class="text-sm mt-2">SANAPATI - Sistem Akuntabilitas dan Navigasi Kinerja Siber-Sandi Terintegrasi</p>
        </div>
    </footer>
    
    @stack('scripts')
</body>
</html>
