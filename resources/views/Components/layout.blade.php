<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>OLIN</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <style>
        /* Custom font for a technical look */
        body {
            font-family: 'SF Mono', 'Fira Code', monospace;
            -webkit-font-smoothing: antialiased;
            -moz-osx-font-smoothing: grayscale;
            @apply bg-gray-900 text-gray-200;
        }

        /* Technical-style scrollbar for a clean feel */
        ::-webkit-scrollbar {
            width: 8px;
        }
        ::-webkit-scrollbar-track {
            background: #111827; /* Dark gray */
        }
        ::-webkit-scrollbar-thumb {
            background: #4B5563; /* Lighter gray */
            border-radius: 4px;
        }
        ::-webkit-scrollbar-thumb:hover {
            background: #6B7280; /* Even lighter on hover */
        }
    </style>
</head>
<body class="bg-gray-900 text-gray-200 min-h-screen flex flex-col overflow-hidden">
    <header class="flex justify-between items-center px-8 py-4 bg-gray-900 border-b border-gray-700 shadow-xl">
        <div class="text-3xl font-extrabold text-white tracking-widest relative">
            <span class="bg-clip-text text-transparent bg-gradient-to-r from-cyan-400 to-blue-500">OLIN</span>
            <div class="absolute inset-0 bg-gradient-to-r from-cyan-400 to-blue-500 opacity-20 blur-sm"></div>
        </div>

        <div class="user-actions flex items-center space-x-6">
            {{-- Create Course Button - Glowing Accent --}}
            <a href="{{ Route('course.create') }}" class="relative text-white font-bold py-2 px-5 rounded-full overflow-hidden transition-all duration-300 transform hover:scale-105
               bg-gradient-to-r from-blue-600 to-blue-500 shadow-md hover:shadow-lg shadow-blue-500/50">
                <span class="relative z-10">+ Create Course</span>
                <div class="absolute inset-0 bg-blue-400 opacity-0 transition-opacity duration-300 hover:opacity-10"></div>
            </a>
            
            <div class="user-info flex items-center space-x-3">
                <img src="https://via.placeholder.com/40" alt="User Avatar" class="w-10 h-10 rounded-full object-cover border-2 border-cyan-500/50 transform hover:scale-110 transition-transform duration-300">
        
                <span class="instructor-name text-gray-400 text-sm">
                    @auth
                        @if(Auth::user()->role === 'instructor')
                            {{ Auth::user()->name }}
                        @else
                            Guest/Admin
                        @endif
                    @else
                        Guest
                    @endauth
                </span>
            </div>
        </div>
    </header>

    <div class="flex flex-1 overflow-hidden">
        <nav class="w-64 bg-gray-800 border-r border-gray-700 p-6 shadow-2xl md:flex flex-col hidden">
            <ul class="space-y-4">
                <li><a href="{{ route('instructor.dashboard') }}" class="relative group block py-3 px-4 rounded-xl text-gray-300 hover:bg-gray-700 font-medium transition-all duration-200">
                    <span class="relative z-10">Active Classes</span>
                    <div class="absolute inset-y-0 right-0 w-1 bg-cyan-400 rounded-full opacity-0 group-hover:opacity-100 transition-opacity duration-200"></div>
                </a></li>
                <li><a href="#" class="relative group block py-3 px-4 rounded-xl text-gray-300 hover:bg-gray-700 font-medium transition-all duration-200">
                    <span class="relative z-10">Chronos Log</span>
                    <div class="absolute inset-y-0 right-0 w-1 bg-cyan-400 rounded-full opacity-0 group-hover:opacity-100 transition-opacity duration-200"></div>
                </a></li>
                <li><a href="#" class="relative group block py-3 px-4 rounded-xl text-gray-300 hover:bg-gray-700 font-medium transition-all duration-200">
                    <span class="relative z-10">Task Registry</span>
                    <div class="absolute inset-y-0 right-0 w-1 bg-cyan-400 rounded-full opacity-0 group-hover:opacity-100 transition-opacity duration-200"></div>
                </a></li>
                <li><a href="#" class="relative group block py-3 px-4 rounded-xl text-gray-300 hover:bg-gray-700 font-medium transition-all duration-200">
                    <span class="relative z-10">Settings</span>
                    <div class="absolute inset-y-0 right-0 w-1 bg-cyan-400 rounded-full opacity-0 group-hover:opacity-100 transition-opacity duration-200"></div>
                </a></li>
                <li>
                    <form method="POST" action="{{ route('logout') }}" class="relative group block py-3 px-4 rounded-xl text-gray-300 hover:bg-gray-700 font-medium transition-all duration-200">
                        @csrf
                        <button type="submit" class="w-full text-left">Logout</button>
                        <div class="absolute inset-y-0 right-0 w-1 bg-cyan-400 rounded-full opacity-0 group-hover:opacity-100 transition-opacity duration-200"></div>
                    </form>
                </li>
            </ul>
        </nav>

        <main class="flex-1 p-8 overflow-y-auto">
            <?php echo $slot ?>
        </main>
    </div>
    {{ $scripts ?? '' }}
</body>
</html>