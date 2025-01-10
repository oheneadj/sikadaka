<x-app-layout>
    <main
        class="flex h-auto min-h-screen flex-col items-center justify-center gap-2 rounded-lg dark:bg-gray-700 md:ml-20">
        <div class="flex flex-col gap-2">
            <div class="mr-5 flex w-full justify-end pr-5">
                <a href="{{ route('donation.create') }}"
                    class="flex items-center justify-center rounded-lg bg-black px-5 py-2.5 text-center text-sm font-medium text-white hover:bg-gray-800 focus:outline-none focus:ring-4 focus:ring-gray-300 dark:bg-gray-200 dark:hover:bg-gray-500 dark:focus:ring-gray-800">
                    <svg class="-ms-1 me-1 h-5 w-5" fill="currentColor" viewBox="0 0 20 20"
                        xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd"
                            d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z"
                            clip-rule="evenodd"></path>
                    </svg>
                    Register New Donor
                </a>
            </div>
            <div class="mx-5 bg-white p-5 shadow-md dark:bg-gray-700 sm:rounded-lg">
                <livewire:donors-table />
            </div>
        </div>
    </main>
</x-app-layout>
