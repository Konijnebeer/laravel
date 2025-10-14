@props(['followed' => false, 'liked' => false])

<article
    class="rounded-2xl {{ $followed && $liked ? 'bg-orange-700' : ($followed ? 'bg-orange-400' : ($liked ? 'bg-yellow-400' : 'bg-yellow-200'))}}">
    <div>
        <img src="{{ $imageLink }}" alt="{{ $imageName }}">
    </div>
    <h1>{{ $title }}</h1>
</article>
