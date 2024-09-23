<?php

namespace App\Repositories\Contracts;

interface BlogPostRepositoryInterface
{
    public function findAllForUser($userId);

    public function getAllBlogPosts();

    public function fetchPostWithUser($userId);
}