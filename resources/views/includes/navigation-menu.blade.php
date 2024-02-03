<nav class="bg-white border-b border-gray-200">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex">
                <!-- Logo -->
                <div class="shrink-0 flex items-center">
                    <a href="">
                        <x-application-mark class="block h-9 w-auto" />
                    </a>
                </div>

                <!-- Navigation Links -->
                <div class="hidden space-x-8 sm:-my-px sm:ms-6 sm:flex">
                    <x-nav-link>
                        {{ __('Dashboard') }}
                    </x-nav-link>

                    <x-nav-link>
                        {{ __('Payments') }}
                    </x-nav-link>

                    <x-nav-link>
                        {{ __('Transactions') }}
                    </x-nav-link>
                </div>
            </div>
        </div>
    </div>
</nav>