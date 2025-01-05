<x-app-layout>

    <main class="items-between flex h-auto min-h-screen justify-center rounded-lg p-4 pt-20 dark:bg-gray-700 md:ml-20">
        <div class="w-full max-w-lg">
            <div class="flex items-center justify-center rounded-t p-4 dark:border-gray-600 md:p-5">
                <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                    Pay Development Levy (Oman Toc)
                </h3>
            </div>
            <br>



            @csrf
            @if ($members->count() == 0)
                <div class="rounded-md bg-white p-3">
                    <p class="mb-4 rounded-md bg-red-50 p-2 text-center text-red-500">
                        You need to register a member before you can receive Development Levy
                    </p>
                    <a href="{{ route('member.create') }}"
                        class="inline-flex w-full items-center justify-center rounded-lg bg-black px-5 py-2.5 text-center text-sm font-medium text-white hover:bg-gray-800 focus:outline-none focus:ring-4 focus:ring-gray-300 dark:bg-gray-600 dark:hover:bg-gray-700 dark:focus:ring-gray-800">
                        Click to register a member
                    </a>
                </div>
            @else
                <livewire:levy-payment />
            @endif


        </div>
    </main>
</x-app-layout>
<script src="https://cdn.jsdelivr.net/npm/jquery@3.7.1/dist/jquery.min.js"></script>
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

<script>
    $(document).ready(function() {
        $('.js-example-basic-single').select2();
    });
</script>
