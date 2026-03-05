@props(['items'])
<script type="application/ld+json">
{
    "@@context": "https://schema.org",
    "@@type": "BreadcrumbList",
    "itemListElement": [
        @foreach($items as $index => $item)
        {
            "@@type": "ListItem",
            "position": {{ $index + 1 }},
            "name": "{{ addslashes($item['name'] ?? '') }}",
            "item": "{{ addslashes($item['url'] ?? '') }}"
        }@if(!$loop->last),@endif
        @endforeach
    ]
}
</script>
