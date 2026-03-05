<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use League\CommonMark\CommonMarkConverter;

class Post extends Model
{
    protected $fillable = [
        'title',
        'slug',
        'excerpt',
        'content',
        'featured_image',
        'published_at',
        'is_published',
        'meta_title',
        'meta_description',
    ];

    protected $casts = [
        'is_published' => 'boolean',
        'published_at' => 'datetime',
    ];

    protected static function booted(): void
    {
        static::saving(function (Post $post) {
            if (empty($post->slug) && ! empty($post->title)) {
                $post->slug = Str::slug($post->title);
            }
        });
    }

    public function getRouteKeyName(): string
    {
        return 'slug';
    }

    public function getFeaturedImageUrlAttribute(): ?string
    {
        return $this->featured_image ? url('storage/' . $this->featured_image) : null;
    }

    public function scopePublished($query)
    {
        return $query->where('is_published', true)
            ->where(function ($q) {
                $q->whereNull('published_at')
                    ->orWhere('published_at', '<=', now());
            });
    }

    /**
     * Renders content based on detected format: Markdown, HTML, or plain text.
     * Auto-detects: Markdown (##, **, -, etc.), HTML (from RichEditor), or plain text.
     */
    public function getRenderedContentAttribute(): string
    {
        $content = $this->content ?? '';

        if (trim($content) === '') {
            return '';
        }

        // Rich HTML from editor (has proper structure: headings, lists, blockquotes as HTML)
        if ($this->looksLikeRichHtml($content)) {
            return $content;
        }

        // Possibly Markdown wrapped in <p> (e.g. pasted into editor)
        $stripped = $this->extractTextFromHtml($content);
        if ($this->looksLikeMarkdown($stripped)) {
            return $this->renderMarkdown($stripped);
        }

        // Pure Markdown (no HTML)
        if ($this->looksLikeMarkdown($content)) {
            return $this->renderMarkdown($content);
        }

        // Has HTML tags (from editor) but not Markdown -> render as HTML
        if (str_contains($content, '<')) {
            return $content;
        }

        // Plain text: escape and wrap in paragraphs
        return '<p>' . nl2br(e($content)) . '</p>';
    }

    /**
     * Extract plain text from HTML preserving paragraph/line structure for Markdown.
     * Converts </p>, <br> to newlines so Markdown structure (headings, lists, paragraphs) is preserved.
     */
    private function extractTextFromHtml(string $content): string
    {
        $content = str_replace(['<br>', '<br/>', '<br />'], "\n", $content);
        $content = str_replace('</p>', "\n\n", $content);
        $content = str_replace('</div>', "\n\n", $content);
        $content = strip_tags($content);
        $content = html_entity_decode($content, ENT_QUOTES | ENT_HTML5, 'UTF-8');

        return trim(preg_replace("/\n{3,}/", "\n\n", $content));
    }

    private function looksLikeRichHtml(string $content): bool
    {
        // RichEditor produces semantic tags: <h2>, <h3>, <ul>, <ol>, <blockquote>, etc.
        // Plain <p> wrappers (from pasting Markdown) don't count as rich HTML
        return (bool) preg_match('/<(h[1-6]|ul|ol|blockquote|table|thead|tbody)[\s>]/i', $content);
    }

    private function looksLikeMarkdown(string $content): bool
    {
        $patterns = [
            '/#{1,6}\s+\w/',           // # Heading
            '/\*\*[^*]+\*\*/',         // **bold**
            '/\*[^*]+\*/',             // *italic*
            '/^\s*[-*]\s/m',           // - list item
            '/^\s*\d+\.\s/m',           // 1. ordered list
            '/\[.+\]\(.+\)/',          // [link](url)
            '/^>\s/m',                 // > blockquote
            '/```/',                   // code block
        ];

        foreach ($patterns as $pattern) {
            if (preg_match($pattern, $content)) {
                return true;
            }
        }

        return false;
    }

    private function renderMarkdown(string $content): string
    {
        // Normalize line endings for consistent parsing (Windows \r\n -> \n)
        $content = str_replace(["\r\n", "\r"], "\n", $content);

        $converter = new CommonMarkConverter([
            'html_input' => 'escape',
            'allow_unsafe_links' => false,
        ]);

        $result = $converter->convert($content);

        return (string) $result;
    }
}
