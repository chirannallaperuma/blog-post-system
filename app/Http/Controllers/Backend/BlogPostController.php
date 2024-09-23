<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Helpers\ApiHelper;
use App\Repositories\Contracts\BlogPostRepositoryInterface;
use Illuminate\Support\Facades\Log;
use Throwable;

class BlogPostController extends Controller
{
    use ApiHelper;

    private $blogPostRepository;

    public function __construct(BlogPostRepositoryInterface $blogPostRepository)
    {
        $this->blogPostRepository = $blogPostRepository;
    }

    /**
     * blogPostsList
     *
     * @return void
     */
    public function blogPostsList()
    {
        try {
            $blogPosts = $this->blogPostRepository->getAllBlogPosts();

            return $this->apiSuccess($blogPosts);
        } catch (Throwable $th) {
            Log::error("BlogPostController (blogPostsList) : error fetching blog post list'  | Reason - {$th->getMessage()}" . PHP_EOL . $th->getTraceAsString());

            return $this->apiError("something went wrong");
        }
    }
    
    /**
     * fetchPost
     *
     * @param  mixed $id
     * @return void
     */
    public function fetchPost($id)
    {
        try {
            $blogPost = $this->blogPostRepository->fetchPostWithUser($id);

            return $this->apiSuccess($blogPost);
        } catch (Throwable $th) {
            Log::error("BlogPostController (fetchPost) : error fetching blog post'  | Reason - {$th->getMessage()}" . PHP_EOL . $th->getTraceAsString());

            return $this->apiError("something went wrong");
        }
    }
}
