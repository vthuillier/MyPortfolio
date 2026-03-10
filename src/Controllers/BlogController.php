<?php

namespace App\Controllers;

use App\Models\Post;
use App\Models\Analytics;

class BlogController extends Controller
{
    public function index()
    {
        $posts = Post::all(true);
        Analytics::logEvent('page_view', '/blog');
        $this->render('blog', ['posts' => $posts]);
    }

    public function show($slug)
    {
        $post = Post::findBySlug($slug);
        if (!$post) {
            http_response_code(404);
            $this->redirect('/blog');
        }

        Analytics::logEvent('page_view', '/blog/' . $slug);
        $this->render('blog_detail', ['post' => $post]);
    }
}
