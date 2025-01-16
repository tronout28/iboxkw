<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">

<div class="w-64 bg-blue-500 text-white p-6">
    <div class="text-2xl font-bold mb-8">&lt;hai/&gt;</div>
    <nav class="space-y-4">
        <a href="{{ route('admin.dashboard.dashboard') }}" 
           class="block py-2.5 px-4 rounded flex items-center {{ Request::routeIs('admin.dashboard.dashboard') ? 'bg-blue-700' : 'hover:bg-blue-600' }}">
            <i class="fas fa-tachometer-alt mr-2"></i> Dashboard
        </a>

        <a href="{{ route('admin.dealer.dealer') }}" 
           class="block py-2.5 px-4 rounded flex items-center {{ Request::routeIs('admin.dealer.dealer') ? 'bg-blue-700' : 'hover:bg-blue-600' }}">
            <i class="fas fa-mobile-alt mr-2"></i> Product
        </a>

        <a href="{{ route('admin.artikel.artikel') }}" 
        class="block py-2.5 px-4 rounded flex items-center {{ Request::routeIs('admin.artikel.artikel') ? 'bg-blue-700' : 'hover:bg-blue-600' }}">
         <i class="fas fa-newspaper mr-2"></i> Artikel 
     </a>
    </nav>
</div>
