<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Repositories\Contracts\BlogPostRepositoryInterface;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class BlogsController extends Controller
{
    /**
     * blogPostRepository
     *
     * @var mixed
     */
    private $blogPostRepository;

    /**
     * __construct
     *
     * @param  mixed $blogPostRepository
     * @return void
     */
    public function __construct(BlogPostRepositoryInterface $blogPostRepository)
    {
        $this->blogPostRepository = $blogPostRepository;
    }

    /**
     * index
     *
     * @return void
     */
    public function index()
    {
        $user = Auth::user();

        $blogPosts = $this->blogPostRepository->findAllForUser($user->id);

        return view('blogs.index', ['blogPosts' => $blogPosts]);
    }

    /**
     * create
     *
     * @return void
     */
    public function create()
    {
        return view('blogs.create');
    }

    /**
     * store
     *
     * @param  mixed $request
     * @return void
     */
    public function store(Request $request)
    {
        $rules = [
            'title' => 'required|string|max:255',
            'description' => 'required|string',
        ];

        $input = $request->all();

        $validator = Validator::make($input, $rules);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        try {
            $user = Auth::user();

            $input['user_id'] = $user->id;

            $this->blogPostRepository->create($input);

            return redirect()->back()->with('alert', 'Successfully created');
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'An error occurred while creating the blog post. Please try again.');
        }
    }


    /**
     * update
     *
     * @param  mixed $request
     * @param  mixed $id
     * @return void
     */
    public function update(Request $request, $id)
    {
        $rules = [
            'title' => 'required|string|max:255',
            'description' => 'required|string',
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        try {
            $this->blogPostRepository->update($id, [
                'title' => $request->title,
                'description' => $request->description
            ]);

            return redirect()->back()->with('alert', 'Successfully updated');
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'An error occurred while updating the blog post. Please try again.');
        }
    }

    /**
     * delete
     *
     * @param  mixed $id
     * @return void
     */
    public function delete($id)
    {
        try {
            $blogPost = $this->blogPostRepository->find($id);

            if (!$blogPost) {
                return response()->json(['success' => false, 'message' => 'Blog post not found.'], 404);
            }

            $blogPost->delete();

            return response()->json(['success' => true, 'message' => 'Successfully deleted']);
        } catch (Exception $e) {
            return response()->json(['success' => false, 'message' => 'An error occurred while deleting the blog post. Please try again.'], 500);
        }
    }
}
