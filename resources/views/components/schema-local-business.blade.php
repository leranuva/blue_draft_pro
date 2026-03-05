@php
    $contact = $contact ?? [];
    $testimonials = $testimonials ?? [];
    $siteUrl = config('app.url');
    $reviews = [];
    if (!empty($testimonials['testimonial1']['rating'])) {
        $reviews[] = ['author' => $testimonials['testimonial1']['name'] ?? 'Client', 'rating' => (int)($testimonials['testimonial1']['rating'] ?? 5), 'reviewBody' => $testimonials['testimonial1']['text'] ?? ''];
    }
    if (!empty($testimonials['testimonial2']['rating'])) {
        $reviews[] = ['author' => $testimonials['testimonial2']['name'] ?? 'Client', 'rating' => (int)($testimonials['testimonial2']['rating'] ?? 5), 'reviewBody' => $testimonials['testimonial2']['text'] ?? ''];
    }
    if (!empty($testimonials['testimonial3']['rating'])) {
        $reviews[] = ['author' => $testimonials['testimonial3']['name'] ?? 'Client', 'rating' => (int)($testimonials['testimonial3']['rating'] ?? 5), 'reviewBody' => $testimonials['testimonial3']['text'] ?? ''];
    }
    $avgRating = count($reviews) > 0 ? round(array_sum(array_column($reviews, 'rating')) / count($reviews), 1) : null;
@endphp
<script type="application/ld+json">
{
    "@@context": "https://schema.org",
    "@@type": "LocalBusiness",
    "name": "Blue Draft",
    "description": "Expert Construction Solutions. Residential and commercial construction, renovations.",
    "url": "{{ $siteUrl }}",
    "telephone": "{{ $contact['phone'] ?? $contact['phone_link'] ?? '+13476366128' }}",
    "address": {
        "@@type": "PostalAddress",
        "streetAddress": "{{ $contact['address'] ?? '358 Amboy St, Brooklyn' }}",
        "addressLocality": "Brooklyn",
        "addressRegion": "NY",
        "postalCode": "11212",
        "addressCountry": "US"
    }
    @if($avgRating)
    ,"aggregateRating": {
        "@@type": "AggregateRating",
        "ratingValue": "{{ $avgRating }}",
        "bestRating": "5",
        "worstRating": "1",
        "ratingCount": "{{ count($reviews) }}",
        "reviewCount": "{{ count($reviews) }}"
    }
    @endif
}
</script>
