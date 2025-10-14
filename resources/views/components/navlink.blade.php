@props(['active' => false])

<li><a {{ $attributes }} style="color: {{ $active ? 'red' : 'blue' }}">{{ $slot }}</a></li>
