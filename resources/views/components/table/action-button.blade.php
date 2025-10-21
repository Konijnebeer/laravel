@props(['action', 'row', 'config' => null])

@if($action === 'edit')
    <a href="{{ route('tags.edit', $row->id) }}" class="text-blue-600 hover:text-blue-700 mx-1">Edit</a>
@elseif($action === 'delete')
    <form method="POST" action="{{ route('tags.destroy', $row->id) }}" class="inline">
        @csrf
        @method('DELETE')
        <button type="submit" class="text-red-600 hover:text-red-700 mx-1">Delete</button>
    </form>
@elseif($action === 'toggle' && is_array($config))
    @php
        $field = $config['field'] ?? 'published';
        $isTrue = data_get($row, $field);
        $label = $isTrue ? ($config['true_label'] ?? 'Disable') : ($config['false_label'] ?? 'Enable');
    @endphp
    <form method="POST" action="{{ route($config['route'], $row->id) }}" class="inline">
        @csrf
        <button type="submit" class="text-yellow-600 hover:text-yellow-700 mx-1">{{ $label }}</button>
    </form>
@endif
