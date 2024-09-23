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

    /**
     * getAllBlogPosts
     *
     * @return void
     */
    public function getAllBlogPosts()
    {
        $blogPosts = $this->model->with('user')->paginate(10);

        return $blogPosts;
    }


    /**
     * fetchPostWithUser
     *
     * @param  mixed $id
     * @return void
     */
    public function fetchPostWithUser($id)
    {
        $blogPost = $this->model
            ->with('user')
            ->find($id);

        return $blogPost;
    }
}
