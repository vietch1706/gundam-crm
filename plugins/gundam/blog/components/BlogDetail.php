<?php

namespace Gundam\Blog\components;

use Cms\Classes\ComponentBase;
use Gundam\Blog\Models\Blog;
use Log;

class BlogDetail extends ComponentBase
{
    public function componentDetails()
    {
        return [
            'name' => 'Blog Post',
            'description' => 'Displays a full blog post based on the slug'
        ];
    }

    public function defineProperties()
    {
        return [
            'slug' => [
                'title' => 'Blog Slug',
                'description' => 'The slug used to find the blog post',
                'default' => '{{ :slug }}',
                'type' => 'string',
            ],
            'limit' => [
                'title' => 'Number of blogs',
                'default' => 3,
                'type' => 'string',
            ]
        ];
    }

    public function onRun()
    {
        $slug = $this->property('slug');
        $blog = Blog::where('slug', $slug)
            ->where('status', Blog::STATUS_PUBLISHED)
            ->first();
        if (!$blog) {
            return \Redirect::to('/404');
        }
        $perPage = (int)$this->property('limit');
        $blogs = Blog::where('slug', '!=', $slug)
            ->where('status', Blog::STATUS_PUBLISHED)
            ->inRandomOrder()
            ->take($perPage)
            ->get();
        Log::info($blogs);
        $this->page['other_blogs'] = $blogs;
        $blog->view++;
        $blog->save();
        $this->page['blog'] = $blog;
    }
}
