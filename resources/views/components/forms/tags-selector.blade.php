@php
    use App\Models\Tag;
    $selected = collect($selectedTags ?? [])->map(fn($v) => (int)$v)->toArray();

function renderTagRecursive($tag, $selected, $level = 0, $name = 'tags[]') {
    $indent = $level * 14;
    $checkboxSize = $level === 0 ? 'w-5 h-5' : 'w-4 h-4';
    $labelClass = $level === 0 ? 'text-primary font-medium' : 'text-primary/80 text-sm';
    $isChecked = in_array($tag->id, $selected) ? 'checked' : '';

    $html = '<div class="space-y-2">';
    $html .= '<div class="flex items-center gap-2" style="margin-left: ' . $indent . 'px;">';
    $html .= '<input name="' . e($name) . '" id="tag_' . $tag->id . '" type="checkbox" value="' . $tag->id . '" ' . $isChecked . ' class="' . $checkboxSize . ' text-success bg-white border-primary/20 rounded focus:ring-2 focus:ring-primary transition-colors">';
    $html .= '<label for="tag_' . $tag->id . '" class="' . $labelClass . ' cursor-pointer">' . e($tag->name) . '</label>';
    $html .= '</div>';

    $children = Tag::where('parent_id', $tag->id)->get();
    if ($children->count() > 0) {
        foreach ($children as $child) {
            $html .= renderTagRecursive($child, $selected, $level + 1, $name);
        }
    }

    $html .= '</div>';
    return $html;
}
@endphp


<div class="tags-selector">
    <p class="text-primary font-semibold text-lg mb-4">Tags</p>
    <div class="flex flex-row gap-6 justify-around flex-wrap">
        @foreach(Tag::where('parent_id', '=', null)->get() as $tag)
            {!! renderTagRecursive($tag, $selected, 0, $name ?? 'tags[]') !!}
        @endforeach
    </div>
</div>
