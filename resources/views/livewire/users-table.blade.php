<div>
    <div class="relative overflow-x-auto p-5 shadow-md">
        <div
            class="flex-column flex flex-wrap items-center justify-between space-y-4 bg-white py-4 dark:bg-gray-900 md:flex-row md:space-y-0">
            <div>
                <button id="dropdownActionButton" data-dropdown-toggle="dropdownAction"
                    class="inline-flex items-center rounded-lg border border-gray-300 bg-white px-3 py-1.5 text-sm font-medium text-gray-500 hover:bg-gray-100 focus:outline-none focus:ring-4 focus:ring-gray-100 dark:border-gray-600 dark:bg-gray-800 dark:text-gray-400 dark:hover:border-gray-600 dark:hover:bg-gray-700 dark:focus:ring-gray-700"
                    type="button">
                    <span class="sr-only">Action button</span>
                    Action
                    <svg class="ms-2.5 h-2.5 w-2.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                        viewBox="0 0 10 6">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="m1 1 4 4 4-4" />
                    </svg>
                </button>
                <!-- Dropdown menu -->
                <div id="dropdownAction"
                    class="z-10 hidden w-44 divide-y divide-gray-100 rounded-lg bg-white shadow dark:divide-gray-600 dark:bg-gray-700">
                    <ul class="py-1 text-sm text-gray-700 dark:text-gray-200" aria-labelledby="dropdownActionButton">
                        <li>
                            <a href="#"
                                class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Reward</a>
                        </li>
                        <li>
                            <a href="#"
                                class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Promote</a>
                        </li>
                        <li>
                            <a href="#"
                                class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Activate
                                account</a>
                        </li>
                    </ul>
                    <div class="py-1">
                        <a href="#"
                            class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:text-gray-200 dark:hover:bg-gray-600 dark:hover:text-white">Delete
                            User</a>
                    </div>
                </div>
            </div>
            <label for="table-search" class="sr-only">Search</label>
            <div class="relative">
                <div class="rtl:inset-r-0 pointer-events-none absolute inset-y-0 start-0 flex items-center ps-3">
                    <svg class="h-4 w-4 text-gray-500 dark:text-gray-400" aria-hidden="true"
                        xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z" />
                    </svg>
                </div>
                <input wire:model.live.debounce.300ms = 'search' type="text" id="table-search-users"
                    class="block w-80 rounded-lg border border-gray-300 bg-gray-50 ps-10 pt-2 text-sm text-gray-900 focus:border-blue-500 focus:ring-blue-500 dark:border-gray-600 dark:bg-gray-700 dark:text-white dark:placeholder-gray-400 dark:focus:border-blue-500 dark:focus:ring-blue-500"
                    placeholder="Search for users">
            </div>
        </div>
        <table class="w-full text-left text-sm text-gray-500 dark:text-gray-400 rtl:text-right">
            <thead class="bg-gray-50 text-xs uppercase text-gray-700 dark:bg-gray-700 dark:text-gray-400">
                <tr>
                    <th scope="col" class="px-6 py-3" wire:click="setSortBy('name')">
                        <button class="flex items-center">
                            Name
                            @if ($sortBy !== 'name')
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                                    class="ml-1 size-4">
                                    <path fill-rule="evenodd"
                                        d="M11.47 4.72a.75.75 0 0 1 1.06 0l3.75 3.75a.75.75 0 0 1-1.06 1.06L12 6.31 8.78 9.53a.75.75 0 0 1-1.06-1.06l3.75-3.75Zm-3.75 9.75a.75.75 0 0 1 1.06 0L12 17.69l3.22-3.22a.75.75 0 1 1 1.06 1.06l-3.75 3.75a.75.75 0 0 1-1.06 0l-3.75-3.75a.75.75 0 0 1 0-1.06Z"
                                        clip-rule="evenodd" />
                                </svg>
                            @elseif ($sortDirection === 'DESC')
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                                    class="ml-1 size-4">
                                    <path fill-rule="evenodd"
                                        d="M11.47 7.72a.75.75 0 0 1 1.06 0l7.5 7.5a.75.75 0 1 1-1.06 1.06L12 9.31l-6.97 6.97a.75.75 0 0 1-1.06-1.06l7.5-7.5Z"
                                        clip-rule="evenodd" />
                                </svg>
                            @else
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                                    class="ml-1 size-4">
                                    <path fill-rule="evenodd"
                                        d="M12.53 16.28a.75.75 0 0 1-1.06 0l-7.5-7.5a.75.75 0 0 1 1.06-1.06L12 14.69l6.97-6.97a.75.75 0 1 1 1.06 1.06l-7.5 7.5Z"
                                        clip-rule="evenodd" />
                                </svg>
                            @endif
                        </button>
                    </th>
                    <th scope="col" class="px-6 py-3 capitalize" wire:click="setSortBy('role')">
                        Role
                    </th>
                    <th scope="col" class="px-6 py-3" wire:click="setSortBy('password_changed_at')">
                        <button class="flex items-center">
                            Password Reset
                            @if ($sortBy !== 'password_changed_at')
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                                    class="ml-1 size-4">
                                    <path fill-rule="evenodd"
                                        d="M11.47 4.72a.75.75 0 0 1 1.06 0l3.75 3.75a.75.75 0 0 1-1.06 1.06L12 6.31 8.78 9.53a.75.75 0 0 1-1.06-1.06l3.75-3.75Zm-3.75 9.75a.75.75 0 0 1 1.06 0L12 17.69l3.22-3.22a.75.75 0 1 1 1.06 1.06l-3.75 3.75a.75.75 0 0 1-1.06 0l-3.75-3.75a.75.75 0 0 1 0-1.06Z"
                                        clip-rule="evenodd" />
                                </svg>
                            @elseif ($sortDirection === 'DESC')
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                                    class="ml-1 size-4">
                                    <path fill-rule="evenodd"
                                        d="M11.47 7.72a.75.75 0 0 1 1.06 0l7.5 7.5a.75.75 0 1 1-1.06 1.06L12 9.31l-6.97 6.97a.75.75 0 0 1-1.06-1.06l7.5-7.5Z"
                                        clip-rule="evenodd" />
                                </svg>
                            @else
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                                    class="ml-1 size-4">
                                    <path fill-rule="evenodd"
                                        d="M12.53 16.28a.75.75 0 0 1-1.06 0l-7.5-7.5a.75.75 0 0 1 1.06-1.06L12 14.69l6.97-6.97a.75.75 0 1 1 1.06 1.06l-7.5 7.5Z"
                                        clip-rule="evenodd" />
                                </svg>
                            @endif
                        </button>
                    </th>

                    <th class="px-6 py-3 text-center capitalize">
                        Status
                    </th>

                    <th colspan="3" class="px-6 py-3 text-center capitalize">
                        Action
                    </th>
                </tr>
            </thead>
            <tbody>
                @forelse ($users as $user)
                    <tr wire:key="{{ $user->id }}"
                        class="border-b bg-white hover:bg-gray-50 dark:border-gray-700 dark:bg-gray-800 dark:hover:bg-gray-600">
                        <th scope="row"
                            class="flex items-center whitespace-nowrap px-6 py-4 text-gray-900 dark:text-white">
                            <img class="h-8 w-8 rounded-full" src="{{ asset('profile.webp') }}" alt="Jese image">
                            <div class="ps-3">
                                <a href="{{ route('user.single', $user->id) }}">
                                    <div class="text-base font-semibold">{{ $user->name }}</div>
                                    <div class="font-normal text-gray-500">{{ $user->email }}</div>
                                </a>
                            </div>
                        </th>
                        <td class="px-6 py-4">
                            @if ($user->role->name === 'Admin')
                                <div class="flex items-center">
                                    <span class="rounded-md bg-red-600 px-2 py-0.5 text-white">
                                        {{ $user->role->name ?? '' }}</span>
                                </div>
                            @elseif ($user->role->name === 'Collector')
                                <div class="flex items-center">
                                    <span class="rounded-md bg-green-500 px-2 py-0.5 text-white">
                                        {{ $user->role->name ?? '' }}</span>
                                </div>
                            @else
                                <div class="flex items-center">
                                    <span class="rounded-md bg-blue-600 px-2 py-0.5 text-white">
                                        {{ $user->role->name ?? '' }}</span>
                                </div>
                            @endif
                        </td>
                        <td class="px-6 py-4">
                            @if ($user->password_changed_at !== null)
                                <div class="flex items-center">
                                    <div class="me-2 h-2.5 w-2.5 rounded-full bg-green-500"></div> Changed
                                </div>
                            @else
                                <div class="flex items-center">
                                    <div class="me-2 h-2.5 w-2.5 rounded-full bg-red-500"></div>Unchanged
                                </div>
                            @endif
                        </td>
                        <td class="px-6 py-4">
                            @if ($user->status === 'active')
                                <label class="mb-5 mt-5 inline-flex cursor-pointer items-center justify-center">
                                    <input type="checkbox" value="" class="peer sr-only"
                                        wire:click="toggle_user_status({{ $user->id }})" checked>
                                    <div
                                        class="peer relative h-5 w-9 rounded-full bg-green-200 after:absolute after:start-[2px] after:top-[2px] after:h-4 after:w-4 after:rounded-full after:border after:border-gray-300 after:bg-white after:transition-all after:content-[''] peer-checked:bg-green-600 peer-checked:after:translate-x-full peer-checked:after:border-white peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-green-300 dark:border-gray-600 dark:bg-gray-700 dark:peer-focus:ring-green-800 rtl:peer-checked:after:-translate-x-full">
                                    </div>
                                    <span
                                        class="ms-3 text-sm font-medium text-gray-900 dark:text-gray-300">Active</span>
                                </label>
                            @else
                                <label class="mb-5 mt-5 inline-flex cursor-pointer items-center justify-center">
                                    <input type="checkbox" value="" class="peer sr-only"
                                        wire:click="toggle_user_status({{ $user->id }})">
                                    <div
                                        class="peer relative h-5 w-9 rounded-full bg-red-200 after:absolute after:start-[2px] after:top-[2px] after:h-4 after:w-4 after:rounded-full after:border after:border-gray-300 after:bg-white after:transition-all after:content-[''] peer-checked:bg-green-600 peer-checked:after:translate-x-full peer-checked:after:border-white peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-green-300 dark:border-gray-600 dark:bg-gray-700 dark:peer-focus:ring-green-800 rtl:peer-checked:after:-translate-x-full">
                                    </div>
                                    <span
                                        class="ms-3 text-sm font-medium text-gray-900 dark:text-gray-300">Inactive</span>
                                </label>
                            @endif
                        </td>
                        <td class="px-6 py-4">
                            <!-- Modal toggle -->
                            <button wire:click="reset_user_password({{ $user->id }})"
                                class="flex justify-between rounded-md bg-green-100 px-2 py-0.5 text-xs font-medium text-green-600 hover:bg-green-500 hover:text-white dark:text-green-500">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                                    class="mr-1 size-4">
                                    <path
                                        d="M18 1.5c2.9 0 5.25 2.35 5.25 5.25v3.75a.75.75 0 0 1-1.5 0V6.75a3.75 3.75 0 1 0-7.5 0v3a3 3 0 0 1 3 3v6.75a3 3 0 0 1-3 3H3.75a3 3 0 0 1-3-3v-6.75a3 3 0 0 1 3-3h9v-3c0-2.9 2.35-5.25 5.25-5.25Z" />
                                </svg>Reset Password
                            </button>
                        </td>
                        <td class="px-6 py-4">
                            <!-- Modal toggle -->
                            <a href="{{ route('user.edit', $user->id) }}"
                                class="font-medium text-blue-600 hover:underline dark:text-blue-500">Edit
                            </a>
                        </td>
                        <td class="px-6 py-4">
                            <button onclick=" confirm('Are you sure?') || event.stopImmediatePropagation()"
                                wire:click="delete({{ $user->id }})"
                                class="block px-4 py-2 text-red-700 dark:text-red-300 dark:hover:bg-red-700">Delete</button>

                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="p-3 text-center">
                            No data found...
                        </td>
                    </tr>
                @endforelse


            </tbody>
        </table>
        <div class="w-32 pt-4">
            <select wire:model.live='per_page'
                class="inline-flex items-center rounded-lg border border-gray-300 bg-white px-3 py-1.5 text-sm font-medium text-gray-500 hover:bg-gray-100 focus:outline-none focus:ring-4 focus:ring-gray-100 dark:border-gray-600 dark:bg-gray-800 dark:text-gray-400 dark:hover:border-gray-600 dark:hover:bg-gray-700 dark:focus:ring-gray-700">
                <option selected>per page</option>
                <option value="5">5</option>
                <option value="10">10</option>
                <option value="25">25</option>
                <option value="50">50</option>
            </select>
        </div>
        <div class="pt-3">
            {{ $users->links() }}
        </div>

    </div>
</div>
