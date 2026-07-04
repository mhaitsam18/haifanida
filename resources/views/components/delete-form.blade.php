@props(['action', 'label' => 'Hapus data ini?'])

<form action="{{ $action }}" method="post"
    x-data
    @submit.prevent="if (confirm('{{ $label }}')) $el.submit()">
    @csrf
    @method('delete')
    <button type="submit" {{ $attributes->merge(['class' => 'inline-flex items-center gap-1 rounded-md bg-red-50 px-2.5 py-1 text-xs font-medium text-red-700 hover:bg-red-100']) }}>
        <i class="bx bx-trash"></i> Hapus
    </button>
</form>
