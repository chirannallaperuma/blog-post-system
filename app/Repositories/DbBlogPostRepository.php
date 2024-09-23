<?php

namespace App\Repositories;

use App\Models\BlogPostModel;
use App\Repositories\Contracts\BlogPostRepositoryInterface;

class DbBlogPostRepository extends BaseRepository implements BlogPostRepositoryInterface
{    
    /**
     * __construct
     *
     * @param  mixed $model
     * @return void
     */
    public function __construct(BlogPostModel $model)
    {
        $this->model = $model;
    }
    
    /**
     * findAllForUser
     *
     * @param  mixed $userId
     * @return void
     */
    public function findAllForUser($userId)
    {
        $blogPosts = $this->model->where('user_id', $userId)->paginate(10);

        return $blogPosts;
    }
}
