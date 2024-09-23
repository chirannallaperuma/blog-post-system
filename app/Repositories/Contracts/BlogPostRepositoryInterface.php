<?php

namespace App\Repositories\Contracts;

interface BlogPostRepositoryInterface
{
    public function findAllForUser($userId);
}