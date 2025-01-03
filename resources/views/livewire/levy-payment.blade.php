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
                <li class="border-b-solid cursor-pointer border-b-2 border-indigo-600 px-3 py-3 hover:bg-gray-100"
                    wire:click="selectMember({{ $member->id }})" key="{{ $member->id }}">
                    {{ "{$member->name} - {$member->membership_id}" }}
                </li>
                @if ($member->id == null)
                    <li class="border-b-solid cursor-pointer border-b-2 border-indigo-600 px-3 py-3 hover:bg-gray-100">
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
                <button type="submit"
                    class="my-3 w-full rounded-lg bg-black px-5 py-2.5 text-center text-sm font-medium text-white hover:bg-gray-800 hover:bg-red-800 focus:outline-none focus:ring-4 focus:ring-gray-300 dark:bg-gray-600 dark:hover:bg-gray-700 dark:focus:ring-gray-800">
                    Pay Outstanding Debt
                </button>
            </form>
        </div>
    @endif

    @if (isset($selected_member->name) && $selected_member->outstanding_debt == 0)
        <div class="col-span-2 mt-4 rounded-md bg-white px-4 py-4">
            <p>Pay Levy for <span class="font-bold">{{ $selected_member->name }}</span></p>
            <form class="pt-3" wire:submit.prevent="pay_levy"> <!-- Combine forms and add prevent modifier -->
                <div class="col-span-2">
                    <label for="amount" class="mb-2 block text-sm font-medium text-gray-900 dark:text-white">Enter
                        Levy amount<span class="text-red-500">*</span></label>
                    <input type="text" name="amount" id="amount" wire:model="amount"
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
                    <ul
                        class="flex w-full flex-wrap items-center rounded-lg border border-gray-200 bg-white text-sm font-medium text-gray-900 dark:border-gray-600 dark:bg-gray-700 dark:text-white sm:flex">
                        <li class="w-full border-b border-gray-200 dark:border-gray-600 sm:border-b-0 sm:border-r">
                            <div class="flex items-center ps-3">
                                <input id="vue-checkbox-list" type="checkbox" value=""
                                    class="h-4 w-4 rounded border-gray-300 bg-gray-100 text-blue-600 focus:ring-2 focus:ring-blue-500 dark:border-gray-500 dark:bg-gray-600 dark:ring-offset-gray-700 dark:focus:ring-blue-600 dark:focus:ring-offset-gray-700">
                                <label for="vue-checkbox-list"
                                    class="ms-2 w-full py-3 text-sm font-medium text-gray-900 dark:text-gray-300">Jan
                                    2024</label>
                            </div>
                        </li>
                        <li class="w-full border-b border-gray-200 dark:border-gray-600 sm:border-b-0 sm:border-r">
                            <div class="flex items-center ps-3">
                                <input id="react-checkbox-list" type="checkbox" value=""
                                    class="h-4 w-4 rounded border-gray-300 bg-gray-100 text-blue-600 focus:ring-2 focus:ring-blue-500 dark:border-gray-500 dark:bg-gray-600 dark:ring-offset-gray-700 dark:focus:ring-blue-600 dark:focus:ring-offset-gray-700">
                                <label for="react-checkbox-list"
                                    class="ms-2 w-full py-3 text-sm font-medium text-gray-900 dark:text-gray-300">Feb
                                    2024</label>
                            </div>
                        </li>
                        <li class="w-full border-b border-gray-200 dark:border-gray-600 sm:border-b-0 sm:border-r">
                            <div class="flex items-center ps-3">
                                <input id="angular-checkbox-list" type="checkbox" value=""
                                    class="h-4 w-4 rounded border-gray-300 bg-gray-100 text-blue-600 focus:ring-2 focus:ring-blue-500 dark:border-gray-500 dark:bg-gray-600 dark:ring-offset-gray-700 dark:focus:ring-blue-600 dark:focus:ring-offset-gray-700">
                                <label for="angular-checkbox-list"
                                    class="ms-2 w-full py-3 text-sm font-medium text-gray-900 dark:text-gray-300">Mar
                                    2024</label>
                            </div>
                        </li>
                        <li class="w-full border-b border-gray-200 dark:border-gray-600 sm:border-b-0 sm:border-r">
                            <div class="flex items-center ps-3">
                                <input id="angular-checkbox-list" type="checkbox" value=""
                                    class="h-4 w-4 rounded border-gray-300 bg-gray-100 text-blue-600 focus:ring-2 focus:ring-blue-500 dark:border-gray-500 dark:bg-gray-600 dark:ring-offset-gray-700 dark:focus:ring-blue-600 dark:focus:ring-offset-gray-700">
                                <label for="angular-checkbox-list"
                                    class="ms-2 w-full py-3 text-sm font-medium text-gray-900 dark:text-gray-300">Apr
                                    2024</label>
                            </div>
                        </li>
                    </ul>

                    @error('amount')
                        <small class="text-xs font-bold text-red-500">
                            {{ $message }}
                        </small>
                    @enderror
                </div>
                <button type="submit"
                    class="my-3 w-full rounded-lg bg-black px-5 py-2.5 text-center text-sm font-medium text-white hover:bg-gray-800 hover:bg-red-800 focus:outline-none focus:ring-4 focus:ring-gray-300 dark:bg-gray-600 dark:hover:bg-gray-700 dark:focus:ring-gray-800">
                    Pay Levy
                </button>
            </form>
        </div>
    @endif






    {{-- <form class="p-4 md:p-5" action="{{ route('payment.new') }}" method="POST"
    enctype="multipart/form-data">
    <div class="mb-4 grid grid-cols-2 gap-4">
        <div class="col-span-2">
            <label for="name" class="mb-2 block text-sm font-medium text-gray-900 dark:text-white">Enter name or
                Member ID number<span class="text-red-500">*</span></label>
            <select name="contributor_id" id="contributor_id"
                class="js-example-basic-single block w-full rounded-lg border border-gray-300 bg-gray-50 p-2.5 text-sm text-gray-900 focus:border-primary-600 focus:ring-primary-600 dark:border-gray-500 dark:bg-gray-600 dark:text-white dark:placeholder-gray-400 dark:focus:border-primary-500 dark:focus:ring-primary-500"
                placeholder="Type member name or ID number">
                <option>Type member name or ID number</option>
                @foreach ($members as $member)
                    <option value="{{ $member->id }}" {{ old('contributor_id') == $member->id ? 'selected' : '' }}>
                        {{ "{$member->name} - {$member->membership_id}" }}</option>
                @endforeach
            </select>
            @error('contributor_id')
                <small class="text-xs font-bold text-red-500">
                    {{ $message }}
                </small>
            @enderror
        </div>

        <div class="col-span-2">
            <label for="amount" class="mb-2 block text-sm font-medium text-gray-900 dark:text-white">Amount<span
                    class="text-red-500">*</span></label>
            <input type="numeric" name="amount" id="amount"
                class="block w-full rounded-lg border border-gray-300 bg-gray-50 p-2.5 text-sm text-gray-900 focus:border-primary-600 focus:ring-primary-600 dark:border-gray-500 dark:bg-gray-600 dark:text-white dark:placeholder-gray-400 dark:focus:border-primary-500 dark:focus:ring-primary-500"
                placeholder="100" value="{{ old('amount') }}">
            @error('amount')
                <small class="text-xs font-bold text-red-500">
                    {{ $message }}
                </small>
            @enderror
        </div>


    </div>

    <button id="submit" type="submit"
        class="inline-flex w-full items-center justify-center rounded-lg bg-black px-5 py-2.5 text-center text-sm font-medium text-white hover:bg-gray-800 focus:outline-none focus:ring-4 focus:ring-gray-300 dark:bg-gray-600 dark:hover:bg-gray-700 dark:focus:ring-gray-800">
        <svg class="-ms-1 me-1 h-5 w-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
            <path fill-rule="evenodd"
                d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z"
                clip-rule="evenodd"></path>
        </svg>
        Pay Development Levy
    </button>
    </form> --}}



</div>
