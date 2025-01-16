<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dealer Detail</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body class="bg-gray-100">
    <div class="flex min-h-screen">
        @include('admin.sidebar.sidebar') <!-- Sidebar -->

        <div class="flex-1 p-8">
            <div class="max-w-4xl mx-auto">
                <div class="bg-white rounded-lg shadow-lg overflow-hidden">
                    <!-- Header -->
                    <div class="p-6 border-b border-gray-200">
                        <div class="flex justify-between items-center">
                            <h1 class="text-2xl font-bold text-gray-900">Dealer Details</h1>
                            <a href="{{ url()->previous() }}" class="px-4 py-2 bg-gray-100 text-gray-600 rounded-lg hover:bg-gray-200">
                                <i class="fas fa-arrow-left mr-2"></i>Back
                            </a>
                        </div>
                    </div>
                    <!-- Content -->
                    <div class="p-6">
                        <!-- Image -->
                        <div class="mb-8">
                            @if($dealer->image)
                                <img src="{{ asset('storage/' . $dealer->image) }}" alt="Dealer Image" class="w-full max-w-2xl h-auto rounded-lg shadow">
                            @else
                                <div class="w-full max-w-2xl h-48 bg-gray-200 rounded-lg flex items-center justify-center">
                                    <i class="fas fa-image text-4xl text-gray-400"></i>
                                </div>
                            @endif
                        </div>

                        <!-- Details Grid -->
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <!-- Left Column -->
                            <div class="space-y-6">
                                <div>
                                    <h3 class="text-sm font-medium text-gray-500">Name</h3>
                                    <p class="mt-1 text-lg font-semibold text-gray-900">{{ $dealer->name }}</p>
                                </div>

                                <div>
                                    <h3 class="text-sm font-medium text-gray-500">Description</h3>
                                    <p class="mt-1 text-gray-900">{{ $dealer->description }}</p>
                                </div>

                                <div>
                                    <h3 class="text-sm font-medium text-gray-500">Price</h3>
                                    <p class="mt-1 text-lg font-semibold text-gray-900">
                                        ${{ number_format($dealer->price, 2) }}
                                    </p>
                                </div>
                            </div>

                            <!-- Right Column -->
                            <div class="space-y-6">
                                <div>
                                    <h3 class="text-sm font-medium text-gray-500">User</h3>
                                    <p class="mt-1 text-gray-900">{{ $dealer->user->name ?? 'No user assigned' }}</p>
                                </div>

                                <div>
                                    <h3 class="text-sm font-medium text-gray-500">Request Status</h3>
                                    <div class="mt-1">
                                        @switch($dealer->requested)
                                            @case('non-accepted')
                                                <span class="px-3 py-1 rounded-full text-sm bg-yellow-100 text-yellow-800">
                                                    Pending
                                                </span>
                                                @break
                                            @case('accepted')
                                                <span class="px-3 py-1 rounded-full text-sm bg-green-100 text-green-800">
                                                    Accepted
                                                </span>
                                                @break
                                            @case('rejected')
                                                <span class="px-3 py-1 rounded-full text-sm bg-red-100 text-red-800">
                                                    Rejected
                                                </span>
                                                @break
                                            @default
                                                <span class="px-3 py-1 rounded-full text-sm bg-gray-100 text-gray-600">
                                                    Unknown Status
                                                </span>
                                        @endswitch
                                    </div>
                                </div>

                                <div>
                                    <h3 class="text-sm font-medium text-gray-500">Status</h3>
                                    <div class="mt-1">
                                        @if($dealer->status === 'active')
                                            <span class="px-3 py-1 rounded-full text-sm bg-green-100 text-green-800">
                                                Active
                                            </span>
                                        @else
                                            <span class="px-3 py-1 rounded-full text-sm bg-red-100 text-red-800">
                                                Inactive
                                            </span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
