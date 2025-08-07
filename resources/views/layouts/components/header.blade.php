<div>
    <nav class="bg-white shadow-lg border-b border-gray-200">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-16">
                <div class="flex items-center space-x-4">
                    Shop System
                </div>
                
                <ul class="flex items-center space-x-4">
                    <li class="relative">
                        <a href="/" class="flex items-center space-x-2 text-gray-700 hover:text-gray-900">
                            <span class="w-6 h-4 bg-red-600 rounded-sm"></span>
                            <span class="text-sm font-medium">English</span>
                        </a>
                    </li>
                    <li class="hidden lg:block">
                        <button class="text-gray-500 hover:text-gray-700 p-2 rounded-md" id="theme-toggle">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z"></path>
                            </svg>
                        </button>
                    </li>
                    @if (auth()->check())
                        <li class="relative">
                            <button class="flex items-center space-x-3 text-gray-700 hover:text-gray-900 focus:outline-none" id="user-dropdown">
                                <div class="hidden sm:block text-right">
                                    <span class="text-sm font-medium">{{ auth()->user()->name }}</span>
                                </div>
                                <div class="relative">
                                    @if (auth()->user()->gender == 'male')
                                        <img class="h-8 w-8 rounded-full" src="../app-assets/images/portrait/small/male.png" alt="avatar">
                                    @elseif (auth()->user()->gender == 'female')
                                        <img class="h-8 w-8 rounded-full" src="../app-assets/images/portrait/small/female.png" alt="avatar">
                                    @endif
                                    <span class="absolute bottom-0 right-0 block h-2 w-2 rounded-full bg-green-400 ring-2 ring-white"></span>
                                </div>
                            </button>
                            <div class="hidden absolute right-0 mt-2 w-48 bg-white rounded-md shadow-lg py-1 z-50" id="user-dropdown-menu">
                                <a href="/users/profile" class="flex items-center px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                                    <svg class="w-4 h-4 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                    </svg>
                                    Profile
                                </a>
                                <form method="POST" action="{{ route('user.logout') }}" class="block">
                                    @csrf
                                    <button type="submit" class="flex items-center w-full px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                                        <svg class="w-4 h-4 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path>
                                        </svg>
                                        Logout
                                    </button>
                                </form>
                            </div>
                        </li>
                    @endif
                </ul>
            </div>
        </div>
    </nav>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script>
    $(document).ready(function() {
        // User dropdown toggle
        $('#user-dropdown').click(function(e) {
            e.stopPropagation();
            $('#user-dropdown-menu').toggleClass('hidden');
        });

        // Close dropdown when clicking outside
        $(document).click(function() {
            $('#user-dropdown-menu').addClass('hidden');
        });

        // Menu toggle for mobile
        $('#menu-toggle').click(function() {
            // Add your menu toggle logic here
            console.log('Menu toggle clicked');
        });

        // Theme toggle
        $('#theme-toggle').click(function() {
            // Add your theme toggle logic here
            console.log('Theme toggle clicked');
        });

        // Layout preference handling
        var savedLayout = localStorage.getItem('layoutPreference') || 'light-layout';
        var $html = $('html');
        $html.removeClass('semi-dark-layout dark-layout bordered-layout');

        if (savedLayout === 'dark-layout') {
            $html.addClass('dark-layout');
            $('body').addClass('bg-gray-900 text-white');
        } else if (savedLayout === 'bordered-layout') {
            $html.addClass('bordered-layout');
        } else if (savedLayout === 'semi-dark-layout') {
            $html.addClass('semi-dark-layout');
        } else {
            $html.addClass('light-layout');
        }
    });
</script>
