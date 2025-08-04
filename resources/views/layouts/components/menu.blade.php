<div>
    <div class="bg-white shadow-lg h-screen w-64 fixed left-0 top-0 z-40 transform transition-transform duration-300" id="sidebar">
        <div class="flex items-center justify-between p-4 border-b border-gray-200">
            <a href="/" class="flex items-center space-x-3">
                <div class="w-8 h-8">
                    <img src='/storage/logo.png' alt="logo" class="w-full h-full object-contain">
                </div>
                <h2 class="text-lg font-semibold text-gray-800">Shop System</h2>
            </a>
            <button class="lg:hidden text-gray-500 hover:text-gray-700" id="close-menu">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                </svg>
            </button>
        </div>
        
        <div class="p-4 overflow-y-auto h-full">
            <nav class="space-y-2">
                <!-- Dashboard Section -->
                <div class="mb-4">
                    <h3 class="text-xs font-semibold text-gray-500 uppercase tracking-wider mb-2">Dashboard</h3>
                    <a href="/dashboard" class="flex items-center px-3 py-2 text-sm font-medium text-gray-700 rounded-md hover:bg-gray-100 hover:text-gray-900 {{ Request::segment(1) == 'dashboard' ? 'bg-blue-100 text-blue-700' : '' }}">
                        <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2H5a2 2 0 00-2-2z"></path>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 5a2 2 0 012-2h4a2 2 0 012 2v6H8V5z"></path>
                        </svg>
                        Dashboard
                    </a>

                    <a href="/inventory" class="flex items-center px-3 py-2 text-sm font-medium text-gray-700 rounded-md hover:bg-gray-100 hover:text-gray-900 {{ Request::segment(1) == 'dashboard' ? 'bg-blue-100 text-blue-700' : '' }}">
                        <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2H5a2 2 0 00-2-2z"></path>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 5a2 2 0 012-2h4a2 2 0 012 2v6H8V5z"></path>
                        </svg>
                        Inventory
                    </a>

                    <a href="/inventory-item" class="flex items-center px-3 py-2 text-sm font-medium text-gray-700 rounded-md hover:bg-gray-100 hover:text-gray-900 {{ Request::segment(1) == 'dashboard' ? 'bg-blue-100 text-blue-700' : '' }}">
                        <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2H5a2 2 0 00-2-2z"></path>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 5a2 2 0 012-2h4a2 2 0 012 2v6H8V5z"></path>
                        </svg>
                        Inventory Item
                    </a>

                    <a href="/products" class="flex items-center px-3 py-2 text-sm font-medium text-gray-700 rounded-md hover:bg-gray-100 hover:text-gray-900 {{ Request::segment(1) == 'dashboard' ? 'bg-blue-100 text-blue-700' : '' }}">
                        <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2H5a2 2 0 00-2-2z"></path>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 5a2 2 0 012-2h4a2 2 0 012 2v6H8V5z"></path>
                        </svg>
                        Products
                    </a>

                    <a href="/shops" class="flex items-center px-3 py-2 text-sm font-medium text-gray-700 rounded-md hover:bg-gray-100 hover:text-gray-900 {{ Request::segment(1) == 'dashboard' ? 'bg-blue-100 text-blue-700' : '' }}">
                        <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2H5a2 2 0 00-2-2z"></path>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 5a2 2 0 012-2h4a2 2 0 012 2v6H8V5z"></path>
                        </svg>
                        Shops
                    </a>

                    <a href="/manufactures" class="flex items-center px-3 py-2 text-sm font-medium text-gray-700 rounded-md hover:bg-gray-100 hover:text-gray-900 {{ Request::segment(1) == 'dashboard' ? 'bg-blue-100 text-blue-700' : '' }}">
                        <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2H5a2 2 0 00-2-2z"></path>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 5a2 2 0 012-2h4a2 2 0 012 2v6H8V5z"></path>
                        </svg>
                        Manufactures
                    </a>

                    <a href="/incomes" class="flex items-center px-3 py-2 text-sm font-medium text-gray-700 rounded-md hover:bg-gray-100 hover:text-gray-900 {{ Request::segment(1) == 'dashboard' ? 'bg-blue-100 text-blue-700' : '' }}">
                        <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2H5a2 2 0 00-2-2z"></path>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 5a2 2 0 012-2h4a2 2 0 012 2v6H8V5z"></path>
                        </svg>
                        Incomes
                    </a>

                    <a href="/expenses" class="flex items-center px-3 py-2 text-sm font-medium text-gray-700 rounded-md hover:bg-gray-100 hover:text-gray-900 {{ Request::segment(1) == 'dashboard' ? 'bg-blue-100 text-blue-700' : '' }}">
                        <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2H5a2 2 0 00-2-2z"></path>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 5a2 2 0 012-2h4a2 2 0 012 2v6H8V5z"></path>
                        </svg>
                        Expenses
                    </a>
                </div>

                <!-- User Controllers Section -->
                @if (auth()->check() && (auth()->user()->hasPermission('user.view') || auth()->user()->hasPermission('user.add')))
                    <div class="mb-4">
                        <h3 class="text-xs font-semibold text-gray-500 uppercase tracking-wider mb-2">User Controllers</h3>
                        <div class="space-y-1">
                            @if (auth()->check() && auth()->user()->hasPermission('user.view'))
                                <a href="/users/user/list" class="flex items-center px-3 py-2 text-sm font-medium text-gray-700 rounded-md hover:bg-gray-100 hover:text-gray-900 {{ Request::segment(2) == 'user' && Request::segment(3) == 'list' ? 'bg-blue-100 text-blue-700' : '' }}">
                                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197m13.5-9a2.5 2.5 0 11-5 0 2.5 2.5 0 015 0z"></path>
                                    </svg>
                                    List
                                </a>
                            @endif
                            @if (auth()->check() && auth()->user()->hasPermission('user.add'))
                                <a href="/users/user/add" class="flex items-center px-3 py-2 text-sm font-medium text-gray-700 rounded-md hover:bg-gray-100 hover:text-gray-900 {{ Request::segment(2) == 'user' && Request::segment(3) == 'add' ? 'bg-blue-100 text-blue-700' : '' }}">
                                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"></path>
                                    </svg>
                                    Add
                                </a>
                            @endif
                        </div>
                    </div>
                @endif

                @if (auth()->check() && auth()->user()->hasPermission('roles.view'))
                    <div class="mb-4">
                        <a href="/users/roles" class="flex items-center px-3 py-2 text-sm font-medium text-gray-700 rounded-md hover:bg-gray-100 hover:text-gray-900 {{ Request::segment(2) == 'roles' ? 'bg-blue-100 text-blue-700' : '' }}">
                            <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            Roles
                        </a>
                    </div>
                @endif

                @if (auth()->check() && auth()->user()->hasPermission('permission.view'))
                    <div class="mb-4">
                        <a href="/users/permissions" class="flex items-center px-3 py-2 text-sm font-medium text-gray-700 rounded-md hover:bg-gray-100 hover:text-gray-900 {{ Request::segment(2) == 'permissions' ? 'bg-blue-100 text-blue-700' : '' }}">
                            <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path>
                            </svg>
                            Permissions
                        </a>
                    </div>
                @endif

                <!-- Booking Controllers Section -->
                @if (auth()->check() && (auth()->user()->hasPermission('booking.view') || auth()->user()->hasPermission('booking.add') || auth()->user()->hasPermission('booking.check')))
                    <div class="mb-4">
                        <h3 class="text-xs font-semibold text-gray-500 uppercase tracking-wider mb-2">Booking Controllers</h3>
                        <div class="space-y-1">
                            @if (auth()->check() && auth()->user()->hasPermission('booking.view'))
                                <a href="/booking/list" class="flex items-center px-3 py-2 text-sm font-medium text-gray-700 rounded-md hover:bg-gray-100 hover:text-gray-900 {{ Request::segment(1) == 'booking' && Request::segment(2) == 'list' ? 'bg-blue-100 text-blue-700' : '' }}">
                                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
                                    </svg>
                                    Booking List
                                </a>
                            @endif
                            @if (auth()->check() && auth()->user()->hasPermission('booking.add'))
                                <a href="/booking/add" class="flex items-center px-3 py-2 text-sm font-medium text-gray-700 rounded-md hover:bg-gray-100 hover:text-gray-900 {{ Request::segment(1) == 'booking' && Request::segment(2) == 'add' ? 'bg-blue-100 text-blue-700' : '' }}">
                                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                                    </svg>
                                    Add Booking
                                </a>
                            @endif
                            @if (auth()->check() && auth()->user()->hasPermission('booking.check'))
                                <a href="/booking/check" class="flex items-center px-3 py-2 text-sm font-medium text-gray-700 rounded-md hover:bg-gray-100 hover:text-gray-900 {{ Request::segment(1) == 'booking' && Request::segment(2) == 'check' ? 'bg-blue-100 text-blue-700' : '' }}">
                                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                    Booking Check
                                </a>
                            @endif
                        </div>
                    </div>
                @endif

                <!-- Cafe Controllers Section -->
                @if (auth()->check() && (auth()->user()->hasPermission('bill.view') || auth()->user()->hasPermission('bill.add')))
                    <div class="mb-4">
                        <h3 class="text-xs font-semibold text-gray-500 uppercase tracking-wider mb-2">Cafe Controllers</h3>
                        <div class="space-y-1">
                            @if (auth()->check() && auth()->user()->hasPermission('bill.view'))
                                <a href="/bill/list" class="flex items-center px-3 py-2 text-sm font-medium text-gray-700 rounded-md hover:bg-gray-100 hover:text-gray-900 {{ Request::segment(1) == 'bill' && Request::segment(2) == 'list' ? 'bg-blue-100 text-blue-700' : '' }}">
                                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                    </svg>
                                    Bill List
                                </a>
                            @endif
                            @if (auth()->check() && auth()->user()->hasPermission('bill.add'))
                                <a href="/bill/add" class="flex items-center px-3 py-2 text-sm font-medium text-gray-700 rounded-md hover:bg-gray-100 hover:text-gray-900 {{ Request::segment(1) == 'bill' && Request::segment(2) == 'add' ? 'bg-blue-100 text-blue-700' : '' }}">
                                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                    </svg>
                                    Add Bill
                                </a>
                            @endif
                        </div>
                    </div>
                @endif

                <!-- Payment Controllers Section -->
                @if (auth()->check() && (auth()->user()->hasPermission('expenses.view') || auth()->user()->hasPermission('income.view')))
                    <div class="mb-4">
                        <h3 class="text-xs font-semibold text-gray-500 uppercase tracking-wider mb-2">Payment Controllers</h3>
                        <div class="space-y-1">
                            @if (auth()->check() && auth()->user()->hasPermission('expenses.view'))
                                <a href="/expenses" class="flex items-center px-3 py-2 text-sm font-medium text-gray-700 rounded-md hover:bg-gray-100 hover:text-gray-900 {{ Request::segment(1) == 'expenses' ? 'bg-blue-100 text-blue-700' : '' }}">
                                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 12H4"></path>
                                    </svg>
                                    Expenses List
                                </a>
                            @endif
                            @if (auth()->check() && auth()->user()->hasPermission('income.view'))
                                <a href="/income" class="flex items-center px-3 py-2 text-sm font-medium text-gray-700 rounded-md hover:bg-gray-100 hover:text-gray-900 {{ Request::segment(1) == 'income' ? 'bg-blue-100 text-blue-700' : '' }}">
                                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                                    </svg>
                                    Income List
                                </a>
                            @endif
                        </div>
                    </div>
                @endif

              

                <!-- Settings Section -->
                @if (auth()->check() && (auth()->user()->hasPermission('settings.main.edit') || auth()->user()->hasPermission('settings.pitches.view')))
                    <div class="mb-4">
                        <h3 class="text-xs font-semibold text-gray-500 uppercase tracking-wider mb-2">Settings Controllers</h3>
                        <div class="space-y-1">
                            @if (auth()->check() && auth()->user()->hasPermission('settings.main.edit'))
                                <a href="/settings/main" class="flex items-center px-3 py-2 text-sm font-medium text-gray-700 rounded-md hover:bg-gray-100 hover:text-gray-900 {{ Request::segment(1) == 'settings' && Request::segment(2) == 'main' ? 'bg-blue-100 text-blue-700' : '' }}">
                                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                    </svg>
                                    Main Settings
                                </a>
                            @endif
                            @if (auth()->check() && auth()->user()->hasPermission('settings.pitches.view'))
                                <a href="/settings/pitches" class="flex items-center px-3 py-2 text-sm font-medium text-gray-700 rounded-md hover:bg-gray-100 hover:text-gray-900 {{ Request::segment(1) == 'settings' && Request::segment(2) == 'pitches' ? 'bg-blue-100 text-blue-700' : '' }}">
                                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                                    </svg>
                                    Pitch Settings
                                </a>
                            @endif
                        </div>
                    </div>
                @endif
            </nav>
        </div>
    </div>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script>
    $(document).ready(function() {
        // Mobile menu toggle
        $('#menu-toggle').click(function() {
            $('#sidebar').toggleClass('-translate-x-full');
        });

        $('#close-menu').click(function() {
            $('#sidebar').addClass('-translate-x-full');
        });

        // Close menu when clicking outside on mobile
        $(document).click(function(e) {
            if ($(window).width() < 1024) {
                if (!$(e.target).closest('#sidebar, #menu-toggle').length) {
                    $('#sidebar').addClass('-translate-x-full');
                }
            }
        });

        // Menu state management
        var savedMenuState = localStorage.getItem('menuState');
        var $body = $('body');

        if (savedMenuState === 'expanded') {
            $body.addClass('lg:ml-64');
        } else if (savedMenuState === 'collapsed') {
            $body.removeClass('lg:ml-64');
        }

        // Toggle menu state
        $('.modern-nav-toggle').click(function() {
            if ($body.hasClass('lg:ml-64')) {
                $body.removeClass('lg:ml-64');
                localStorage.setItem('menuState', 'collapsed');
            } else {
                $body.addClass('lg:ml-64');
                localStorage.setItem('menuState', 'expanded');
            }
        });

        // Responsive adjustments
        function adjustLayout() {
            if ($(window).width() < 1024) {
                $body.removeClass('lg:ml-64');
            }
        }

        $(window).resize(adjustLayout);
        adjustLayout();
    });
</script>
