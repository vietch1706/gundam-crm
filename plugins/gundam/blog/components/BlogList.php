<?php

namespace Gundam\Blog\components;

use Cms\Classes\ComponentBase;
use Gundam\Blog\Models\Blog;
use Illuminate\Pagination\Paginator;
use Log;

class BlogList extends ComponentBase
{
    public function componentDetails()
    {
        return [
            'name' => 'Blog List',
            'description' => 'Display blog list.',
        ];
    }

    public function defineProperties()
    {
        return [
            'limit' => [
                'title' => 'Number of blogs',
                'description' => 'How many blogs to display?',
                'default' => 2,
                'type' => 'string',
            ]
        ];
    }

    public function onRun()
    {
        $perPage = $this->property('limit');
        $currentPage = Paginator::resolveCurrentPage();
        $query = Blog::query();
        $blogs = $query->paginate($perPage, $currentPage);
        $this->page['blogs'] = $blogs;
    }

    public function getFirstParagraph($content)
    {
        $content = preg_replace('/<!--.*?-->/', '', $content);
        if (preg_match('/<p>([^<>]+)<\/p>/', $content, $matches)) {
            return $matches[0];
        }
        return '<p>' . substr(strip_tags($content), 0, 150) . '...</p>';
    }
}
