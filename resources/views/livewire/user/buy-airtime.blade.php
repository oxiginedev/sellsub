<div class="py-12">
    <div class="lg:px-8 py-6 mx-auto max-w-lg bg-white overflow-hidden rounded-lg shadow-sm border border-gray-200">
        <div class="mb-5 text-center">
            <h4 class="font-semibold text-xs uppercase tracking-widest">
                {{ __('Purchase Airtime') }}
            </h4>
        </div>

        <form wire:submit="buyAirtime">
            <div>
                <x-label for="network" value="Select network" />
                <div class="flex mt-2 space-x-3">
                    <label class="cursor-pointer">
                        <input type="radio" wire:model="form.network" value="mtn" class="peer sr-only">
                        <div
                            class="relative flex justify-center items-center w-14 h-14 rounded-full ring-2 ring-gray-200 text-gray-300 transition-all peer-checked:text-primary-700 peer-checked:ring-primary-700">
                            <x-icons.mtn class="w-10 h-10" />
                            <x-icons.check-circle class="absolute top-0 right-0 w-4 h-auto" />
                        </div>
                    </label>
                    <label class="cursor-pointer">
                        <input type="radio" wire:model="form.network" value="glo" class="peer sr-only">
                        <div
                            class="relative flex justify-center items-center w-14 h-14 rounded-full ring-2 ring-gray-200 text-gray-300 transition-all peer-checked:text-primary-700 peer-checked:ring-primary-700">
                            <x-icons.glo class="w-10 h-10" />
                            <x-icons.check-circle class="absolute top-0 right-0 w-4 h-auto" />
                        </div>
                    </label>
                    <label class="cursor-pointer">
                        <input type="radio" wire:model="form.network" value="airtel" class="peer sr-only">
                        <div
                            class="relative flex justify-center items-center w-14 h-14 rounded-full ring-2 ring-gray-200 text-gray-300 transition-all peer-checked:text-primary-700 peer-checked:ring-primary-700">
                            <x-icons.airtel class="w-10 h-10" />
                            <x-icons.check-circle class="absolute top-0 right-0 w-4 h-auto" />
                        </div>
                    </label>
                    <label class="cursor-pointer">
                        <input type="radio" wire:model="form.network" value="etisalat" class="peer sr-only">
                        <div
                            class="relative flex justify-center items-center w-14 h-14 rounded-full ring-2 ring-gray-200 text-gray-300 transition-all peer-checked:text-primary-700 peer-checked:ring-primary-700">
                            <x-icons.9mobile class="w-10 h-10" />
                            <x-icons.check-circle class="absolute top-0 right-0 w-4 h-auto" />
                        </div>
                    </label>
                </div>
                @error('form.network')
                    <span class="text-sm text-red-600">{{ $message }}</span>
                @enderror
            </div>

            <div class="mt-4">
                <x-label for="phone" value="Phone number" />
                <x-input x-mask="99999999999" wire:model="form.phone" class="block w-full mt-1"
                    placeholder="e.g 08021212121" />
                @error('form.phone')
                    <span class="text-sm text-red-600">{{ $message }}</span>
                @enderror
            </div>

            <div class="mt-4">
                <x-label for="amount" value="Enter amount" />
                <x-input type="text" x-mask:dynamic="$money($input)" wire:model="form.amount"
                    class="block w-full mt-1" placeholder="e.g 1,500" />
                @error('form.amount')
                    <span class="text-sm text-red-600">{{ $message }}</span>
                @enderror
            </div>

            {{-- <x-button class="w-full justify-center mt-4">
                {{ __('Buy Airtime') }}
            </x-button> --}}

            <a class="group flex h-min items-center disabled:opacity-50 disabled:hover:opacity-50 hover:opacity-95 justify-center ring-none  rounded-md shadow-lg font-semibold py-2 px-4 font-dm focus:outline-none focus-visible:outline-2 focus-visible:outline-offset-2  bg-violet-500 border-b-violet-700 disabled:border-0 disabled:bg-violet-500 disabled:text-white ring-white text-white border-b-4 hover:border-0 active:border-0 hover:text-gray-100 active:bg-violet-800 active:text-gray-300 focus-visible:outline-violet-500 text-sm sm:text-base"
                href="">
                Create demos for free
            </a>
        </form>
    </div>
</div>
