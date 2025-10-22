@props(['items'])

<section class="grid grid-cols-2 sm:grid-cols-4 lg:grid-cols-6 gap-4 auto-rows-[200px] grid-flow-dense">
    @foreach($items as $item)
        @if($item['type'] === 'post')
            <x-post-card :post="$item['data']"/>
        @elseif($item['type'] === 'blog')
            <x-blog-card :blog="$item['data']"/>
        @elseif($item['type'] === 'filler')
            <x-filler-card :filler="$item['data']"/>
        @endif
    @endforeach
</section>
