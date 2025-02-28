<?php

namespace Gundam\Blog\components;

use Cms\Classes\ComponentBase;
use Gundam\Blog\Models\Blog;
use Gundam\Product\Models\Category;
use Illuminate\Pagination\Paginator;
use October\Rain\Exception\ValidationException;
use function abort;

class BlogList extends ComponentBase
{
    public function componentDetails()
    {
        return [
            'name' => 'Blog List',
            'description' => 'Display blog list and paginate.',
        ];
    }

    public function defineProperties()
    {
        return [
            'limit' => [
                'title' => 'Posts Per Page',
                'description' => 'Number of blog posts to display per page',
                'default' => 10,
                'type' => 'string',
                'validationPattern' => '^[0-9]+$',
                'validationMessage' => 'Please enter a valid number'
            ],
            'cache_duration' => [
                'title' => 'Cache Duration (minutes)',
                'description' => 'How long to cache the results (0 to disable)',
                'default' => 60,
                'type' => 'string',
                'validationPattern' => '^[0-9]+$',
            ]
        ];
    }

    public function onRun()
    {
        $perPage = $this->property('limit');
        $currentPage = Paginator::resolveCurrentPage();
        $query = Blog::where('status', Blog::STATUS_PUBLISHED);
        $blogs = $query->paginate($perPage, $currentPage);
        $this->page['blogs'] = $blogs;
        $this->prepareVars();
    }

    public function prepareVars()
    {
        try {
            $category = $this->resolveCategory();
            $this->setPageVariables($category);
        } catch (ValidationException $e) {
            \Log::error('Lỗi xác thực danh sách sản phẩm: ' . $e->getMessage());

            $this->page['errors'] = $e->getErrors();
            $this->page['noProductsMessage'] = $this->property('noProductsMessage');
            abort(404);
        }
    }

    public function getFirstParagraph($content)
    {
        $content = preg_replace('/<!--.*?-->/', '', $content);
        if (preg_match('/<p>([^<>]+)<\/p>/', $content, $matches)) {
            return $matches[0];
        }
        return '<p>' . substr(strip_tags($content), 0, 150) . '...</p>';
    }

    private function resolveCategory()
    {
        $categorySlug = $this->param('slug');

        if (empty($categorySlug)) {
            return null;
        }

        $category = Category::where('slug', $categorySlug)->first();

        if (!$category) {
            throw new ValidationException(['category' => 'Không tìm thấy danh mục']);
        }

        return $category;
    }
}
