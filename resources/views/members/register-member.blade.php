<x-app-layout>
    <main class="flex h-auto min-h-screen items-center justify-center rounded-lg p-4 pt-20 dark:bg-gray-700 md:ml-20">
        <div class="w-full max-w-lg">
            <div class="rounded-md bg-white">
                <div class="flex items-center justify-between rounded-t p-4 dark:border-gray-600 md:p-5">
                    <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                        Register New Member
                    </h3>
                </div>
                <form class="p-4 md:p-5" action="{{ route('member.new') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-4 grid grid-cols-2 gap-4">
                        <div class="col-span-2">
                            <label class="mb-2 block text-sm font-medium text-gray-900 dark:text-white"
                                for="user_avatar">Upload Member Image</label>
                            <div class="flex justify-center">
                                <div class="relative">
                                    <input class="hidden" type="file" id="user_avatar" name="picture_path"
                                        accept="image/*" onchange="previewImage(this)">
                                    <label for="user_avatar"
                                        class="flex h-32 w-32 cursor-pointer items-center justify-center overflow-hidden rounded-full border border-gray-300 bg-gray-50 hover:bg-gray-100 dark:border-gray-600 dark:bg-gray-700 dark:hover:bg-gray-600">
                                        <img id="preview" class="hidden h-full w-full object-cover">
                                        <div id="placeholder" class="text-center">
                                            <svg class="mx-auto mb-1 h-8 w-8 text-gray-500 dark:text-gray-400"
                                                fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                                            </svg>
                                            <span class="text-sm text-gray-500 dark:text-gray-400">Upload</span>
                                        </div>
                                    </label>
                                </div>
                            </div>
                            <div class="mt-1 text-center text-sm text-gray-500 dark:text-gray-300"
                                id="user_avatar_help">SVG, PNG, JPG or GIF</div>
                            @error('picture_path')
                                <small class="text-xs font-bold text-red-500">
                                    {{ $message }}
                                </small>
                            @enderror
                        </div>

                        <div class="col-span-2">
                            <label for="name"
                                class="mb-2 block text-sm font-medium text-gray-900 dark:text-white">Name<span
                                    class="text-red-500">*</span></label>
                            <input type="text" name="name" id="name"
                                class="block w-full rounded-lg border border-gray-300 bg-gray-50 p-2.5 text-sm text-gray-900 focus:border-primary-600 focus:ring-primary-600 dark:border-gray-500 dark:bg-gray-600 dark:text-white dark:placeholder-gray-400 dark:focus:border-primary-500 dark:focus:ring-primary-500"
                                placeholder="Type name" value="{{ old('name') }}">
                            @error('name')
                                <small class="text-xs font-bold text-red-500">
                                    {{ $message }}
                                </small>
                            @enderror
                        </div>

                        <div class="col-span-2 sm:col-span-1">
                            <label for="date_of_birth"
                                class="mb-2 block text-sm font-medium text-gray-900 dark:text-white">Date of Birth<span
                                    class="text-red-500">*</span></label>
                            <input type="date" value="{{ old('date_of_birth', '2005-01-01') }}" name="date_of_birth"
                                id="date_of_birth"
                                class="block w-full rounded-lg border border-gray-300 bg-gray-50 p-2.5 text-sm text-gray-900 focus:border-primary-600 focus:ring-primary-600 dark:border-gray-500 dark:bg-gray-600 dark:text-white dark:placeholder-gray-400 dark:focus:border-primary-500 dark:focus:ring-primary-500"
                                placeholder="02455900993" value="{{ old('date_of_birth') }}">
                            @error('date_of_birth')
                                <small class="text-xs font-bold text-red-500">
                                    {{ $message }}
                                </small>
                            @enderror
                        </div>
                        <div class="col-span-2 sm:col-span-1">
                            <label for="gender"
                                class="mb-2 block text-sm font-medium text-gray-900 dark:text-white">Gender</span></label>
                            <div class="mt-4 flex">
                                <div class="me-4 flex items-center">
                                    <input id="male-gender" type="radio"
                                        {{ old('gender') == 'MALE' ? 'checked' : '' }}
                                        value="{{ old('gender', 'MALE') }}" name="gender"
                                        class="h-4 w-4 border-gray-300 bg-gray-100 text-blue-600 focus:ring-2 focus:ring-blue-500 dark:border-gray-600 dark:bg-gray-700 dark:ring-offset-gray-800 dark:focus:ring-blue-600">
                                    <label for="male-gender"
                                        class="ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">Male</label>
                                </div>
                                <div class="me-4 flex items-center">
                                    <input id="female-gender" type="radio"
                                        {{ old('gender') == 'FEMALE' ? 'checked' : '' }}
                                        value="{{ old('gender', 'FEMALE') }}" name="gender"
                                        class="h-4 w-4 border-gray-300 bg-gray-100 text-blue-600 focus:ring-2 focus:ring-blue-500 dark:border-gray-600 dark:bg-gray-700 dark:ring-offset-gray-800 dark:focus:ring-blue-600">
                                    <label for="female-gender"
                                        class="ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">Female</label>
                                </div>

                            </div>

                            @error('gender')
                                <small class="text-xs font-bold text-red-500">
                                    {{ $message }}
                                </small>
                            @enderror
                        </div>
                        <div class="col-span-2 sm:col-span-1">
                            <label for="phone_number"
                                class="mb-2 block text-sm font-medium text-gray-900 dark:text-white">Phone Number<span
                                    class="text-red-500">*</span></label>
                            <input type="number" name="phone_number" id="phone_number"
                                class="block w-full rounded-lg border border-gray-300 bg-gray-50 p-2.5 text-sm text-gray-900 focus:border-primary-600 focus:ring-primary-600 dark:border-gray-500 dark:bg-gray-600 dark:text-white dark:placeholder-gray-400 dark:focus:border-primary-500 dark:focus:ring-primary-500"
                                placeholder="02455900993" value="{{ old('phone_number') }}">
                            @error('phone_number')
                                <small class="text-xs font-bold text-red-500">
                                    {{ $message }}
                                </small>
                            @enderror
                        </div>
                        <div class="col-span-2 sm:col-span-1">
                            <label for="suburb"
                                class="mb-2 block text-sm font-medium text-gray-900 dark:text-white">Surburb</label>
                            <input type="text" name="suburb" id="suburb"
                                class="block w-full rounded-lg border border-gray-300 bg-gray-50 p-2.5 text-sm text-gray-900 focus:border-primary-600 focus:ring-primary-600 dark:border-gray-500 dark:bg-gray-600 dark:text-white dark:placeholder-gray-400 dark:focus:border-primary-500 dark:focus:ring-primary-500"
                                placeholder="Location in Community" value="{{ old('suburb') }}">
                            @error('suburb')
                                <small class="text-xs font-bold text-red-500">
                                    {{ $message }}
                                </small>
                            @enderror
                        </div>
                        <div class="col-span-2 sm:col-span-1">
                            <label for="phone_number"
                                class="mb-2 block text-sm font-medium text-gray-900 dark:text-white">Clan</label>
                            <select name="clan" id="clan"
                                class="block w-full rounded-lg border border-gray-300 bg-gray-50 p-2.5 text-sm text-gray-900 focus:border-primary-600 focus:ring-primary-600 dark:border-gray-500 dark:bg-gray-600 dark:text-white dark:placeholder-gray-400 dark:focus:border-primary-500 dark:focus:ring-primary-500">
                                <option value="" disabled selected>Select your clan</option>
                                @foreach ($clans as $clan)
                                    <option value="{{ old('clan', $clan['value']) }}">{{ $clan['name'] }}</option>
                                @endforeach
                            </select>

                            @error('clan')
                                <small class="text-xs font-bold text-red-500">
                                    {{ $message }}
                                </small>
                            @enderror
                        </div>
                        <div class="col-span-2 sm:col-span-1">
                            <label for="hometown"
                                class="mb-2 block text-sm font-medium text-gray-900 dark:text-white">Hometown</label>
                            <input type="text" name="hometown" id="hometown"
                                class="block w-full rounded-lg border border-gray-300 bg-gray-50 p-2.5 text-sm text-gray-900 focus:border-primary-600 focus:ring-primary-600 dark:border-gray-500 dark:bg-gray-600 dark:text-white dark:placeholder-gray-400 dark:focus:border-primary-500 dark:focus:ring-primary-500"
                                placeholder="Name of Hometown" value="{{ old('hometown') }}">
                            @error('hometown')
                                <small class="text-xs font-bold text-red-500">
                                    {{ $message }}
                                </small>
                            @enderror
                        </div>
                        <div class="col-span-2">
                            <label for="denomination"
                                class="mb-2 block text-sm font-medium text-gray-900 dark:text-white">Church
                                Denomination</label>
                            <input list="denomination-list" type="text" name="denomination" id="denomination"
                                class="block w-full rounded-lg border border-gray-300 bg-gray-50 p-2.5 text-sm text-gray-900 focus:border-primary-600 focus:ring-primary-600 dark:border-gray-500 dark:bg-gray-600 dark:text-white dark:placeholder-gray-400 dark:focus:border-primary-500 dark:focus:ring-primary-500"
                                placeholder="Type Denomination" value="{{ old('denomination') }}">
                            <datalist id="denomination-list">
                            </datalist>
                            @error('denomination')
                                <small class="text-xs font-bold text-red-500">
                                    {{ $message }}
                                </small>
                            @enderror
                        </div>
                        <div class="col-span-2 mt-3 font-bold">
                            Whom should we contact incase of an emergency?
                            <hr>
                        </div>
                        <div class="col-span-2 sm:col-span-1">
                            <label for="contact_person_name"
                                class="mb-2 block text-sm font-medium text-gray-900 dark:text-white">Name</label>
                            <input type="text" name="contact_person_name" id="contact_person_name"
                                class="block w-full rounded-lg border border-gray-300 bg-gray-50 p-2.5 text-sm text-gray-900 focus:border-primary-600 focus:ring-primary-600 dark:border-gray-500 dark:bg-gray-600 dark:text-white dark:placeholder-gray-400 dark:focus:border-primary-500 dark:focus:ring-primary-500"
                                placeholder="Enter full name" value="{{ old('contact_person_name') }}">
                            @error('contact_person_name')
                                <small class="text-xs font-bold text-red-500">
                                    {{ $message }}
                                </small>
                            @enderror
                        </div>
                        <div class="col-span-2 sm:col-span-1">
                            <label for="contact_person_number"
                                class="mb-2 block text-sm font-medium text-gray-900 dark:text-white">Phone
                                Number</label>
                            <input type="number" name="contact_person_number" id="contact_person_number"
                                class="block w-full rounded-lg border border-gray-300 bg-gray-50 p-2.5 text-sm text-gray-900 focus:border-primary-600 focus:ring-primary-600 dark:border-gray-500 dark:bg-gray-600 dark:text-white dark:placeholder-gray-400 dark:focus:border-primary-500 dark:focus:ring-primary-500"
                                placeholder="024XXXXXXX" value="{{ old('contact_person_number') }}">
                            @error('contact_person_number')
                                <small class="text-xs font-bold text-red-500">
                                    {{ $message }}
                                </small>
                            @enderror
                        </div>
                    </div>
                    <button id="submit" type="submit"
                        class="inline-flex w-full items-center justify-center rounded-lg bg-black px-5 py-2.5 text-center text-sm font-medium text-white hover:bg-gray-800 focus:outline-none focus:ring-4 focus:ring-gray-300 dark:bg-gray-600 dark:hover:bg-gray-700 dark:focus:ring-gray-800">
                        <svg class="-ms-1 me-1 h-5 w-5" fill="currentColor" viewBox="0 0 20 20"
                            xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd"
                                d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z"
                                clip-rule="evenodd"></path>
                        </svg>
                        Register Member
                    </button>
                </form>
            </div>
        </div>
    </main>
</x-app-layout>

<script>
    const denominations = [
        "Roman Catholic Church",
        "Presbyterian Church of Ghana",
        "Methodist Church Ghana",
        "Anglican Church",
        "Pentecost Church",
        "Charismatic Churches",
        "Seventh-day Adventist Church",
        "Church of Jesus Christ of Latter-day Saints",
        "Apostolic Church Ghana",
        "Assemblies of God",
        "Evangelical Presbyterian Church",
        "International Central Gospel Church",
        "Lighthouse Chapel International",
        "Perez Chapel International",
        "Royalhouse Chapel International",
        "Church of Christ",
        "Global Evangelical Church",
        "Christ Embassy",
        "Deeper Christian Life Ministry",
        "Action Chapel International",
        "Christ Apostolic Church International",
        "African Methodist Episcopal (AME)",
        "Jehovah's Witnesses",
        "Redeemed Christian Church of God",
        "Calvary Charismatic Centre (CCC)",
        "Resurrection Power New Generation Church"
    ];

    function populateDenominations() {
        denominations.map(denomination => {
            return (
                document.getElementById('denomination-list').innerHTML +=
                `<option value="${denomination}">${denomination}</option>`
            )
        });
    }
    populateDenominations();

    function previewImage(input) {
        const preview = document.getElementById('preview');
        const placeholder = document.getElementById('placeholder');

        if (input.files && input.files[0]) {
            const reader = new FileReader();

            reader.onload = function(e) {
                preview.src = e.target.result;
                preview.classList.remove('hidden');
                placeholder.classList.add('hidden');
            }

            reader.readAsDataURL(input.files[0]);
        } else {
            preview.classList.add('hidden');
            placeholder.classList.remove('hidden');
        }
    }


    function validateMail(email) {
        let reg = /^[a-zA-Z0-9.!#$%&'*+/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*$/;
        console.log(email)
        if (email.toLowerCase().match(reg)) {
            return true;
        }
        return false
    }
</script>
