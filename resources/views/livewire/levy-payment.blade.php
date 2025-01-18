<div class="mb-4 grid grid-cols-2">
    <div class="col-span-2 mb-3 rounded-md bg-white p-4">
        <input wire:model.live="search" type="text" name="member" id="contact_person_number"
            class="block w-full rounded-lg border border-gray-300 bg-gray-50 p-2.5 text-sm text-gray-900 focus:border-primary-600 focus:ring-primary-600 dark:border-gray-500 dark:bg-gray-600 dark:text-white dark:placeholder-gray-400 dark:focus:border-primary-500 dark:focus:ring-primary-500"
            placeholder="Enter Member Name or ID number">
        @error('member')
            <small class="text-xs font-bold text-red-500">
                {{ $message }}
            </small>
        @enderror
        <ul class="mt-2 w-full rounded-lg bg-white shadow-sm">
            @foreach ($members as $member)
                <li class="border-b-solid border-grey-600 cursor-pointer border-b-2 px-3 py-3 hover:bg-gray-100"
                    wire:click="selectMember({{ $member->id }})" key="{{ $member->id }}">
                    {{ "{$member->name} - {$member->membership_id}" }}
                </li>
                @if ($member->id == null)
                    <li class="border-b-solid cursor-pointer border-b-2 border-gray-600 px-3 py-3 hover:bg-gray-100">
                        No member found
                    </li>
                @endif
            @endforeach
        </ul>
    </div>


    @if (isset($selected_member->outstanding_debt) && $selected_member->outstanding_debt > 0)
        <div class="col-span-2 mt-4 rounded-md bg-white px-4 py-4">
            <p> {{ $selected_member->name }} has
                <span class="text-red-500">{{ Number::currency($selected_member->outstanding_debt, 'GHS') }}</span>
                outstanding debt
            </p>
            <form class="pt-3" wire:submit.prevent="pay_debt"> <!-- Combine forms and add prevent modifier -->
                <div class="col-span-2">
                    <label for="debt_amount" class="mb-2 block text-sm font-medium text-gray-900 dark:text-white">Enter
                        Debt Amount<span class="text-red-500">*</span></label>
                    <input type="text" name="debt_amount" id="debt_amount" wire:model="debt_amount"
                        class="block w-full rounded-lg border border-gray-300 bg-gray-50 p-2.5 text-sm text-gray-900 focus:border-primary-600 focus:ring-primary-600 dark:border-gray-500 dark:bg-gray-600 dark:text-white dark:placeholder-gray-400 dark:focus:border-primary-500 dark:focus:ring-primary-500"
                        placeholder="">
                    @error('debt_amount')
                        <small class="text-xs font-bold text-red-500">
                            {{ $message }}
                        </small>
                    @enderror
                </div>
                <button type="submit" wire:loading.attr="disabled" wire:target="pay_debt"
                    class="my-3 w-full rounded-lg bg-black px-5 py-2.5 text-center text-sm font-medium text-white hover:bg-gray-800 hover:bg-red-800 focus:outline-none focus:ring-4 focus:ring-gray-300 dark:bg-gray-600 dark:hover:bg-gray-700 dark:focus:ring-gray-800">
                    <span wire:loading.remove wire:target="pay_debt">Pay Outstanding Debt</span>
                    <span wire:loading wire:target="pay_debt">
                        <svg aria-hidden="true" role="status" class="me-3 inline h-4 w-4 animate-spin text-white"
                            viewBox="0 0 100 101" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z"
                                fill="#E5E7EB" />
                            <path
                                d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z"
                                fill="currentColor" />
                        </svg>
                        Processing...</span>
                </button>
            </form>
        </div>
    @endif

    @if (isset($selected_member->name) && $selected_member->outstanding_debt == 0)
        <div class="col-span-2 mt-4 flex items-center justify-start rounded-md bg-white px-4 py-4">
            <div class="mr-4 h-24 w-24 overflow-hidden rounded-full">
                <img class="h-full w-full object-cover"
                    src="{{ asset('images/members_images/' . $selected_member->picture_path) ?? asset('profile.webp') }}"
                    alt="">
            </div>
            <div class="flex flex-col">
                <p><span class="font-bold">Member Name: </span>{{ $selected_member->name }}</p>
                <p><span class="font-bold">Membership ID: </span> {{ $selected_member->membership_id }}</p>
                <div class="flex gap-4">
                    <p class="text-sm"><span class="font-bold">Phone: </span>{{ $selected_member->phone_number }}</p>
                    <p class="text-sm"><span class="font-bold">Gender: </span>{{ $selected_member->gender }}</p>
                </div>

            </div>
        </div>

        <div class="col-span-2 mt-4 rounded-md bg-white px-4 py-4">

            <form class="pt-3" wire:submit.prevent="pay_levy"> <!-- Combine forms and add prevent modifier -->
                <div class="col-span-2">
                    <label for="amount" class="mb-2 block text-sm font-medium text-gray-900 dark:text-white">Enter
                        Levy amount<span class="text-red-500">*</span></label>
                    <input type="text" name="amount" id="amount" wire:model.live="amount"
                        class="block w-full rounded-lg border border-gray-300 bg-gray-50 p-2.5 text-sm text-gray-900 focus:border-primary-600 focus:ring-primary-600 dark:border-gray-500 dark:bg-gray-600 dark:text-white dark:placeholder-gray-400 dark:focus:border-primary-500 dark:focus:ring-primary-500"
                        placeholder="">
                    @error('amount')
                        <small class="text-xs font-bold text-red-500">
                            {{ $message }}
                        </small>
                    @enderror
                </div>
                <div class="col-span-2 my-3">
                    <h4 class="mb-2 font-semibold text-gray-900 dark:text-white">Select months you want to pay</h4>

                    <div wire:click="calculatePayments"
                        class="my-3 w-full rounded-lg bg-black px-5 py-2.5 text-center text-sm font-medium text-white hover:bg-gray-800 hover:bg-red-800 focus:outline-none focus:ring-4 focus:ring-gray-300 dark:bg-gray-600 dark:hover:bg-gray-700 dark:focus:ring-gray-800">
                        Calculate</div>
                    <ul
                        class="flex w-full flex-wrap items-center rounded-lg border border-gray-200 bg-white text-sm font-medium text-gray-900 dark:border-gray-600 dark:bg-gray-700 dark:text-white sm:flex">
                        @foreach ($months as $month)
                            <li class="w-full border-b border-gray-200 dark:border-gray-600 sm:border-b-0 sm:border-r">
                                <div class="flex items-center ps-3">
                                    <input wire:model.live="selected_months"
                                        id="{{ $month['month'] . '-' . $month['year'] }}" type="checkbox"
                                        value="{{ $month['key'] }}"
                                        class="month-checkbox h-4 w-4 rounded border-gray-300 bg-gray-100 text-blue-600 focus:ring-2 focus:ring-blue-500 dark:border-gray-500 dark:bg-gray-600 dark:ring-offset-gray-700 dark:focus:ring-blue-600 dark:focus:ring-offset-gray-700">
                                    <label for="{{ $month['month'] . '-' . $month['year'] }}"
                                        class="ms-2 w-full py-3 text-sm font-medium text-gray-900 dark:text-gray-300">{{ $month['month'] }}
                                        - {{ $month['year'] }}</label>
                                </div>
                            </li>
                        @endforeach
                    </ul>
                    @error('amount')
                        <small class="text-xs font-bold text-red-500">
                            {{ $message }}
                        </small>
                    @enderror
                </div>

                {{-- <ul>
                    <li>
                        {{ var_export($selected_months) }}
                    </li>
                    @foreach ($selected_months as $selected_month)
                        <li>
                            {{ $selected_month }}
                        </li>
                    @endforeach
                </ul> --}}
                <div wire:click="pay_levy"
                    class="cursor:pointer my-3 w-full rounded-lg bg-black px-5 py-2.5 text-center text-sm font-medium text-white hover:bg-gray-800 hover:bg-red-800 focus:outline-none focus:ring-4 focus:ring-gray-300 dark:bg-gray-600 dark:hover:bg-gray-700 dark:focus:ring-gray-800">
                    Pay Levy
                </div>
            </form>
        </div>
    @endif

    <script>
        // Add an event listener to all checkboxes
        const checkboxes = document.querySelectorAll('.month-checkbox');
        checkboxes.forEach(checkbox => {
            checkbox.addEventListener('change', () => {
                handleCheckboxChange(checkbox);
            });
        });

        console.log(checkboxes);


        function handleCheckboxChange(checkbox) {
            const value = parseInt(checkbox.value);

            // If the current checkbox is checked, check all previous months
            if (checkbox.checked) {
                checkboxes.forEach(cb => {
                    if (parseInt(cb.value) < value) {
                        cb.checked = true;
                    }
                });
            }
        }
    </script>
</div>
