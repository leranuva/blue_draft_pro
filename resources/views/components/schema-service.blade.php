@props(['service'])
<script type="application/ld+json">
{
    "@@context": "https://schema.org",
    "@@type": "Service",
    "name": "{{ $service->title }}",
    "description": "{{ \Illuminate\Support\Str::limit(strip_tags($service->seo_description ?? $service->content ?? $service->title), 200) }}",
    "provider": {
        "@@type": "LocalBusiness",
        "name": "Blue Draft"
    }
}
</script>
