<div class="mb-4 grid grid-cols-2 gap-4">
    <div class="col-span-2">

        <input type="text" wire:model.live="search_members" placeholder="Search options...">
        <ul>

            @foreach ($members as $member)
                <li value="{{ $member->id }}" {{ old('contributor_id') == $member->id ? 'selected' : '' }}>
                    {{ "{$member->name} - {$member->membership_id}" }}
                </li>
            @endforeach
            {{-- @foreach ($options as $option)
                <li wire:click="selectOption('{{ $option }}')">{{ $option }}</li>
            @endforeach --}}
        </ul>


        <label for="name" class="mb-2 block text-sm font-medium text-gray-900 dark:text-white">Enter name or
            Member ID number<span class="text-red-500">*</span></label>
        <select wire:model.live="selected_member" name="contributor_id" id="contributor_id"
            class="block w-full rounded-lg border border-gray-300 bg-gray-50 p-2.5 text-sm text-gray-900 focus:border-primary-600 focus:ring-primary-600 dark:border-gray-500 dark:bg-gray-600 dark:text-white dark:placeholder-gray-400 dark:focus:border-primary-500 dark:focus:ring-primary-500"
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

    @if ($selected_member)
        <p>{{ $selected_member }}</p>

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
    @endif


</div>
