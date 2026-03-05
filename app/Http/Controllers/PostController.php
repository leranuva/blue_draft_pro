<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Settings;
use Illuminate\View\View;

class PostController extends Controller
{
    public function index(): View
    {
        $posts = Post::published()
            ->orderByDesc('published_at')
            ->orderByDesc('created_at')
            ->paginate(12);

        $contactSettings = Settings::where('group', 'contact')->pluck('value', 'key')->toArray();
        $heroSettings = Settings::where('group', 'hero')->pluck('value', 'key')->toArray();

        return view('blog.index', [
            'posts' => $posts,
            'contact' => [
                'phone' => $contactSettings['contact_phone'] ?? '+1.3476366128',
                'address' => $contactSettings['contact_address'] ?? '358 Amboy St, Brooklyn',
            ],
            'hero' => ['cta_text' => $heroSettings['hero_cta_text'] ?? 'Get Your Free Quote'],
        ]);
    }

    public function show(string $slug): View
    {
        $post = Post::published()->where('slug', $slug)->firstOrFail();

        $contactSettings = Settings::where('group', 'contact')->pluck('value', 'key')->toArray();
        $heroSettings = Settings::where('group', 'hero')->pluck('value', 'key')->toArray();

        $relatedPosts = Post::published()
            ->where('id', '!=', $post->id)
            ->latest('published_at')
            ->take(3)
            ->get();

        return view('blog.show', [
            'post' => $post,
            'relatedPosts' => $relatedPosts,
            'contact' => [
                'phone' => $contactSettings['contact_phone'] ?? '+1.3476366128',
                'phone_link' => str_replace(['.', ' ', '-'], '', $contactSettings['contact_phone'] ?? '13476366128'),
            ],
            'hero' => ['cta_text' => $heroSettings['hero_cta_text'] ?? 'Get Your Free Quote'],
        ]);
    }
}
