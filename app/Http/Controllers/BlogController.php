<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Support\SchemaBuilder;
use Illuminate\Contracts\View\View;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class BlogController extends Controller
{
    private const PER_PAGE = 9;

    public function index(): View
    {
        $posts = Post::published()->latestFirst()->paginate(self::PER_PAGE);

        $title = 'Moving Tips & Packers and Movers Guides | Next Level Blog';
        $description = 'Practical moving guides from working packers and movers in Erode: moving costs, packing '
            .'techniques, office relocation planning and route advice for Tamil Nadu and Bengaluru.';

        $crumbs = [
            ['title' => 'Home', 'url' => route('home')],
            ['title' => 'Blog', 'url' => route('blog.index')],
        ];

        $schema = [
            SchemaBuilder::organization(),
            SchemaBuilder::website(),
            SchemaBuilder::webPage($title, $description, route('blog.index')),
            SchemaBuilder::breadcrumbs($crumbs),
        ];

        return view('blog.index', compact('posts', 'title', 'description', 'schema', 'crumbs'));
    }

    public function show(Post $post): View
    {
        if (! $post->is_published || $post->published_at === null) {
            throw new NotFoundHttpException;
        }

        $post->increment('views');

        $related = Post::published()
            ->latestFirst()
            ->where('id', '!=', $post->id)
            ->limit(3)
            ->get();

        $title = $post->seo_title;
        $description = $post->seo_description;
        $url = route('blog.show', $post);

        $crumbs = [
            ['title' => 'Home', 'url' => route('home')],
            ['title' => 'Blog', 'url' => route('blog.index')],
            ['title' => $post->title, 'url' => $url],
        ];

        $schema = [
            SchemaBuilder::organization(),
            SchemaBuilder::website(),
            SchemaBuilder::webPage($title, $description, $url, [
                'image' => $post->image ? asset($post->image) : null,
                'datePublished' => $post->published_at->toAtomString(),
                'dateModified' => $post->updated_at->toAtomString(),
            ]),
            SchemaBuilder::breadcrumbs($crumbs),
            SchemaBuilder::article($post, $url),
        ];

        return view('blog.show', compact('post', 'related', 'title', 'description', 'schema', 'crumbs'));
    }
}
