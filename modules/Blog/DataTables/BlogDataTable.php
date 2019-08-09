<?php

namespace Modules\Blog\DataTables;

use Auth;
use Datatables;

use Modules\Blog\Models\Post;
use Modules\Store\Models\Category;

use Illuminate\Support\Arr;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class BlogDataTable extends DataTable
{
    /**
     * DataTable only columns
     */
    protected $only = [
        'title',
        'type',
        'author',
        'cates',
        'updated',
        'status',
        'action',
    ];

    /**
     * DataTable raw columns
     */
    protected $columns = [
        'title',
        'author',
        'cates',
        'status',
        'action',
    ];

    /**
     * Build datatable data
     * @example $datatable->build()->toJson();
     */
    public function build()
    {
        $this->user = Auth::user();
        $this->cates = Category::findAndMapWithId();
        $this->dataset = Post::getDataset();

        /**
         * Build query for datatable
         */
        $query = Post::query();

        $datatable = Datatables::from($query);
        $datatable->only($this->only);
        $datatable->rawColumns($this->columns);

        $datatable->editColumn('title', function(Post $node) {
            return '<a href="' . route('post.edit', $node->id) . '">' . $node->title . '</a>';
        });

        $datatable->editColumn('cates', function(Post $node) {
            return $this->formatCates($node);
        });

        $datatable->editColumn('status', function(Post $node) {
            return $this->formatStatus($node);
        });

        $datatable->addColumn('author', function(Post $node) {
            return $this->formatAuthor($node);
        });

        $datatable->addColumn('action', function(Post $node) {
            return $this->formatAction($node);
        });

        $datatable->filter(function ($query) {
            // Check for tab filter
            if ($filter = request()->input('filter')) {
                // Get only published post
                if ($filter == 'published') {
                    $query->where('status', Post::STATUS_ACTIVE);
                }

                // Get only draft post
                if ($filter == 'draft') {
                    $query->where('status', Post::STATUS_DRAFT);
                }

                // Get only trash post
                if ($filter == 'trash') {
                    $query->where('status', Post::STATUS_TRASH);
                }
            }

            // Check for filter:search
            if ($search = request()->input('search.value')) {
                $field = 'title';
                $operator = 'like';

                if (Str::contains($search, ':')) {
                    list($field, $search) = explode(':', $search);
                }

                if ($field == 'id') {
                    $field = '_id';
                    $operator = '=';
                } else {
                    $search = '%' . $search . '%';
                }

                $field = trim($field);
                $search = trim($search);
                $query->where($field, $operator, $search);
            }
        });

        return $datatable;
    }

    protected function formatCates(Post $node)
    {
        if (is_array($node->cates) == false) {
            return $node->cates;
        }

        $collection = collect($node->cates)->map(function($id) {
            if ($cate = $this->cates[$id] ?? null) {
                return '<a href="' . route('category.edit', $cate->id) . '">' . $cate->name . '</a>';
            }
        })->reject(function($item) {
            return empty($item);
        });

        return implode(',', $collection->all());
    }

    protected function formatAuthor(Post $node)
    {
        if ($node->author) {
            return $node->author->name;
        }
        return '';
    }

    protected function formatStatus(Post $node)
    {
        $label = $this->dataset['status'][$node->status] ?? 'N/A';
        $color = $this->dataset['colors'][$node->status] ?? 'default';
        return "<span class=\"label label-{$color}\">{$label}</span>";
    }

    protected function formatAction(Post $node)
    {
        // Show action buttons
        $html = '';

        // Check for edit action
        if ($this->user->can('post.update', $node)) {
            $html .= '<a href="' . route('post.edit',  $node->id) . '" class="btn btn-sm btn-default btn-action"><i class="fa fa-edit text-success"></i></a>';
        }

        // Check for delete action
        if ($this->user->can('post.delete', $node)) {
            $html .= '<form method="POST" action="' . route('post.destroy', $node->_id) .'" accept-charset="UTF-8" style="display:inline">';
            $html .= '<input name="_method" type="hidden" value="DELETE">';
            $html .= csrf_field();
            $html .= '<button class="btn btn-sm btn-default" type="submit"><i class="fa fa-times text-red"></i></button>';
            $html .= '</form>';
        }

        return $html;
    }
}