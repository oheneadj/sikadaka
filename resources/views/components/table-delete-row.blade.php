<form action="{{ route('member.delete') }}" method="POST">
    @csrf
    @method('DELETE')
    <button class="rounded-md bg-red-700 px-3 py-1 text-white hover:bg-red-300" type="submit">Delete</button>
</form>
