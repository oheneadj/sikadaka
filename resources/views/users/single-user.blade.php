<x-app-layout>
    <main
        class="flex min-h-screen bg-gradient-to-br from-gray-50 to-gray-100 p-6 pt-20 dark:from-gray-800 dark:to-gray-900 md:ml-20">
        <div class="container mx-auto max-w-6xl">
            <div class="flex flex-col gap-6 lg:flex-row">
                <!-- Profile Card -->
                <section class="w-full lg:w-1/3">
                    <div
                        class="overflow-hidden rounded-2xl bg-white shadow-lg transition-all hover:shadow-xl dark:bg-gray-800">
                        <!-- Profile Header -->
                        <div class="relative h-32 bg-gradient-to-r from-blue-500 to-blue-600">
                            <div class="absolute -bottom-16 left-1/2 -translate-x-1/2">
                                <div class="relative">
                                    <div
                                        class="h-32 w-32 overflow-hidden rounded-full border-4 border-white bg-white shadow-lg dark:border-gray-700">

                                        <img src="{{ $user->picture_path == null ? '/profile.webp' : "/members_images/$user->profile_photo_url " }}"
                                            alt="Profile" class="h-full w-full object-cover">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Profile Content -->
                        <div class="pt-20">
                            <!-- Name and Contact -->
                            <div class="px-6 pb-6">
                                <div class="flex flex-row items-center justify-center">
                                    <a class="text-center text-sm font-bold text-red-500"
                                        href="{{ route('user.edit', $user->id) }}"><svg
                                            xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                            stroke-width="1.5" stroke="currentColor" class="size-5">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0 1 15.75 21H5.25A2.25 2.25 0 0 1 3 18.75V8.25A2.25 2.25 0 0 1 5.25 6H10" />
                                        </svg>
                                        Edit</a>
                                </div>
                                <div class="text-center">
                                    <h2 class="text-2xl font-bold text-gray-900 dark:text-white">{{ $user->name }}
                                    </h2>
                                    <h4 class="rounded-md px-2 py-0.5 text-sm text-white">
                                        <span class="rounded-md bg-red-600 px-2 py-0.5"> {{ $user->role }}</span>
                                    </h4>
                                </div>

                                <div class="mt-6 space-y-4">
                                    {{-- <div class="flex items-center gap-3 rounded-lg bg-gray-50 p-3 dark:bg-gray-700">
                                        <svg class="h-5 w-5 text-gray-600 dark:text-gray-300"
                                            xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                            stroke-width="1.5" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M2.25 6.75c0 8.284 6.716 15 15 15h2.25a2.25 2.25 0 002.25-2.25v-1.372c0-.516-.351-.966-.852-1.091l-4.423-1.106c-.44-.11-.902.055-1.173.417l-.97 1.293c-.282.376-.769.542-1.21.38a12.035 12.035 0 01-7.143-7.143c-.162-.441.004-.928.38-1.21l1.293-.97c.363-.271.527-.734.417-1.173L6.963 3.102a1.125 1.125 0 00-1.091-.852H4.5A2.25 2.25 0 002.25 4.5v2.25z" />
                                        </svg>
                                        <span
                                            class="text-sm text-gray-600 dark:text-gray-300">{{ $user->phone_number }}</span>
                                    </div> --}}
                                    @if ($user->email !== null)
                                        <div class="flex items-center gap-3 rounded-lg bg-gray-50 p-3 dark:bg-gray-700">
                                            <svg class="h-5 w-5 text-gray-600 dark:text-gray-300"
                                                xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                stroke-width="1.5" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M21.75 6.75v10.5a2.25 2.25 0 01-2.25 2.25h-15a2.25 2.25 0 01-2.25-2.25V6.75m19.5 0A2.25 2.25 0 0019.5 4.5h-15a2.25 2.25 0 00-2.25 2.25m19.5 0v.243a2.25 2.25 0 01-1.07 1.916l-7.5 4.615a2.25 2.25 0 01-2.36 0L3.32 8.91a2.25 2.25 0 01-1.07-1.916V6.75" />
                                            </svg>

                                            <span
                                                class="text-sm text-gray-600 dark:text-gray-300">{{ $user->email }}</span>
                                        </div>
                                    @endif
                                    {{-- <div class="flex items-center gap-3 rounded-lg bg-gray-50 p-3 dark:bg-gray-700">
                                        <svg class="h-5 w-5 text-gray-600 dark:text-gray-300"
                                            xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                            stroke-width="1.5" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M15 10.5a3 3 0 11-6 0 3 3 0 016 0z" />
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1115 0z" />
                                        </svg>
                                        <span
                                            class="text-sm text-gray-600 dark:text-gray-300">{{ $user->suburb }}</span>
                                    </div> --}}
                                </div>
                            </div>
                        </div>
                    </div>
                </section>

                <!-- Stats Cards -->
                <section class="flex w-full flex-col gap-6 lg:w-2/3">
                    <!-- Payment Card -->
                    <div class="rounded-2xl bg-white p-6 shadow-lg transition-all hover:shadow-xl dark:bg-gray-800">
                        <div class="flex items-center gap-3">
                            <svg class="h-8 w-8 text-blue-500" xmlns="http://www.w3.org/2000/svg" fill="none"
                                viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M2.25 18.75a60.07 60.07 0 0115.797 2.101c.727.198 1.453-.342 1.453-1.096V18.75M3.75 4.5v.75A.75.75 0 013 6h-.75m0 0v-.375c0-.621.504-1.125 1.125-1.125H20.25M2.25 6v9m18-10.5v.75c0 .414.336.75.75.75h.75m-1.5-1.5h.375c.621 0 1.125.504 1.125 1.125v9.75c0 .621-.504 1.125-1.125 1.125h-.375m1.5-1.5H21a.75.75 0 00-.75.75v.75m0 0H3.75m0 0h-.375a1.125 1.125 0 01-1.125-1.125V15m1.5 1.5v-.75A.75.75 0 003 15h-.75M15 10.5a3 3 0 11-6 0 3 3 0 016 0zm3 0h.008v.008H18V10.5zm-12 0h.008v.008H6V10.5z" />
                            </svg>
                            <h2 class="text-2xl font-bold text-gray-900 dark:text-white">Payments Overview</h2>
                        </div>

                        <div class="mt-6 grid gap-4 sm:grid-cols-3">
                            <div class="rounded-xl bg-blue-50 p-4 dark:bg-blue-900/20">
                                <div class="text-sm font-medium text-blue-600 dark:text-blue-400">Total Levy
                                    Collected
                                </div>
                                <div class="mt-2 text-2xl font-bold text-blue-700 dark:text-blue-300">
                                    {{ $total_contribution }}</div>
                            </div>
                            <div class="rounded-xl bg-green-50 p-4 dark:bg-green-900/20">
                                <div class="text-sm font-medium text-green-600 dark:text-green-400">Total Donation
                                    Collected</div>
                                <div class="mt-2 text-2xl font-bold text-green-700 dark:text-green-300">
                                    {{ $total_donation }}</div>
                            </div>
                            <div class="rounded-xl bg-red-50 p-4 dark:bg-red-900/20">
                                <div class="text-sm font-medium text-red-600 dark:text-red-400">Total Members Registered
                                </div>
                                <div class="mt-2 text-2xl font-bold text-red-700 dark:text-red-300">
                                    {{ $members }}</div>
                            </div>
                        </div>
                    </div>

                    <!-- Debt Card -->
                    <div class="rounded-2xl bg-white p-6 shadow-lg transition-all hover:shadow-xl dark:bg-gray-800">
                        <div class="flex items-center gap-3">
                            <svg class="h-8 w-8 text-green-500" xmlns="http://www.w3.org/2000/svg" fill="none"
                                viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M12 6v12m-3-2.818l.879.659c1.171.879 3.07.879 4.242 0 1.172-.879 1.172-2.303 0-3.182C13.536 12.219 12.768 12 12 12c-.725 0-1.45-.22-2.003-.659-1.106-.879-1.106-2.303 0-3.182s2.9-.879 4.006 0l.415.33M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            <h2 class="text-2xl font-bold text-gray-900 dark:text-white">All Received Payments Summary
                            </h2>
                        </div>
                    </div>
                    @forelse ($user->payments_received as $payment)
                        <div class="rounded-2xl bg-white p-3 shadow-lg transition-all hover:shadow-xl dark:bg-gray-800">
                            <div class="mt-1">
                                <div class="rounded-xl bg-blue-50 p-4 dark:bg-red-900/20">
                                    <div class="flex justify-between font-medium text-blue-600 dark:text-red-400">
                                        <a class="mb-2 rounded-md bg-black px-2 pt-0.5 text-xs text-white"
                                            href="{{ route('member.single', $payment->contributor_id) }}">Paid By:
                                            {{ $payment->contributor->name }}</a> <span>Date:
                                            {{ $payment->created_at->toFormattedDateString() }}</span>
                                    </div>
                                    <div class="mt-2 text-sm text-xl font-bold text-blue-700 dark:text-red-300">GH₵
                                        {{ $payment->amount }}</div>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="rounded-2xl bg-white p-3 shadow-lg transition-all hover:shadow-xl dark:bg-gray-800">
                            <div class="mt-1">
                                <div class="rounded-xl bg-gray-50 p-4 dark:bg-red-900/20">
                                    <div class="mt-2 text-center text-xl text-gray-700 dark:text-red-300">User
                                        hasn't received any payments yet...</div>
                                </div>
                            </div>
                        </div>
                    @endforelse

                </section>
            </div>
        </div>
    </main>
</x-app-layout>
