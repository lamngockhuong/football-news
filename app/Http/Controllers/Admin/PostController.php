<?php

namespace App\Http\Controllers\Admin;

use DB;
use Storage;
use Illuminate\Database\QueryException;
use App\Models\Post;
use Illuminate\Http\Request;
use App\Http\Requests\PostRequest;
use App\Exception\RepositoryException;
use App\Http\Controllers\Controller;
use App\Repositories\Contracts\CategoryRepositoryInterface;
use App\Repositories\Contracts\PostRepositoryInterface;

class PostController extends Controller
{
    protected $categoryRepository;
    protected $postRepository;

    public function __construct(
        CategoryRepositoryInterface $categoryRepository,
        PostRepositoryInterface $postRepository
    ) {
        $this->categoryRepository = $categoryRepository;
        $this->postRepository = $postRepository;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $this->authorize('access', Post::class);
        // q: query parameter
        $keyword = $request->q;
        $category = $request->category;
        $user = $request->user;
        
        if (isset($keyword)) {
            $posts = $this->postRepository->search($keyword);
            $posts->appends($request->only('q'));
        } else {
            if (isset($category)) {
                $posts = $this->postRepository->postsByCategory($category);
            } else if (isset($user)) {
                $posts = $this->postRepository->postsByUser($user);
            } else {
                $posts = $this->postRepository->posts();
            }
        }

        return view('admin.post.index', compact('posts'));
    }

    public function trashed(Request $request)
    {
        $this->authorize('access', Post::class);
        // q: query parameter
        $keyword = $request->q;
        $category = $request->category;
        $user = $request->user;
        
        if (isset($keyword)) {
            $posts = $this->postRepository->searchOnlyTrash($keyword);
            $posts->appends($request->only('q'));
        } else {
            if (isset($category)) {
                $posts = $this->postRepository->postsByCategoryOnlyTrash($category);
            } else if (isset($user)) {
                $posts = $this->postRepository->postsByUserOnlyTrash($user);
            } else {
                $posts = $this->postRepository->postsOnlyTrash();
            }
        }

        return view('admin.post.trash', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = $this->categoryRepository->categoriesForForm();
        return view('admin.post.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  App\Http\Requests\PostRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PostRequest $request)
    {
        $this->authorize('access', Post::class);
        try {
            $path = $this->upload($request, config('setting.public_post_image'));
            $inputs = $request->all();
            $inputs['image'] = $path;
            $inputs['user_id'] = auth()->user()->id;
            $this->postRepository->create($inputs);

            $message = trans('admin.post.add.message.add_success');
            $notification = [
                'message' => $message,
                'type' => 'success',
            ];
            
            return redirect()->route('posts.index')->with('notification', $notification);
        } catch (Exception $e) {
            Storage::delete($path);
            $message = trans('admin.post.add.message.add_error');
            $notification = [
                'message' => $message,
                'type' => 'danger',
            ];
        }

        return back()->withInput()->with('notification', $notification);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $this->authorize('access', Post::class);
        try {
            $post = $this->postRepository->find($id); // throw RepositoryException when can not found
            $categories = $this->categoryRepository->categoriesForForm();

            return view('admin.post.edit', compact('post', 'categories'));
        } catch (RepositoryException $e) {
            $message = trans('admin.post.edit.message.not_found');
            $notification = [
                'message' => $message,
                'type' => 'danger',
            ];

            return redirect()->back()->with('notification', $notification);
        }
    }

    public function active(Request $request)
    {
        $this->authorize('access', Post::class);
        $post = $this->postRepository->find($request->id); // throw RepositoryException when can not found
        $this->postRepository->update(['is_actived' => (int) $request->is_actived], $post);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  App\Http\Requests\PostRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(PostRequest $request, $id)
    {
        $this->authorize('access', Post::class);
        try {
            $post = $this->postRepository->find($id); // throw RepositoryException when can not found
            $path = $this->upload($request, config('setting.public_post_image'));
            
            $inputs = $request->all();
            if ($path) {
                Storage::delete($post->image);
                $inputs['image'] = $path;
            }

            $this->postRepository->update($inputs, $post);
            $message = trans('admin.post.edit.message.edit_success');
            $notification = [
                'message' => $message,
                'type' => 'success',
            ];

            return redirect()->route('posts.index')->with('notification', $notification);
        } catch (RepositoryException $e) {
            Storage::delete($path);
            $message = trans('admin.post.edit.message.not_found');
            $notification = [
                'message' => $message,
                'type' => 'danger',
            ];

            return back()->withInput()->with('notification', $notification);
        }
    }

    public function trash($id)
    {
        $this->authorize('access', Post::class);
        try {
            $this->postRepository->find($id); // throw RepositoryException when can not found
            $this->postRepository->delete($id);

            $message = trans('admin.post.trash.message.trash_success');
            $notification = [
                'message' => $message,
                'type' => 'success',
            ];
        } catch (RepositoryException $e) {
            $message = trans('admin.post.trash.message.not_found');
            $notification = [
                'message' => $message,
                'type' => 'danger',
            ];
        } catch (QueryException $e) {
            $message = trans('admin.post.trash.message.trash_error');
            $notification = [
                'message' => $message,
                'type' => 'danger',
            ];
        }

        return redirect()->back()->with('notification', $notification);
    }

    public function untrash($id)
    {
        $this->authorize('access', Post::class);
        try {
            $post = $this->postRepository->withTrashed()->find($id); // throw RepositoryException when can not found
            $post->restore();

            $message = trans('admin.post.untrash.message.untrash_success');
            $notification = [
                'message' => $message,
                'type' => 'success',
            ];
        } catch (RepositoryException $e) {
            $message = trans('admin.post.untrash.message.not_found');
            $notification = [
                'message' => $message,
                'type' => 'danger',
            ];
        } catch (QueryException $e) {
            $message = trans('admin.post.untrash.message.untrash_error');
            $notification = [
                'message' => $message,
                'type' => 'danger',
            ];
        }

        return redirect()->back()->with('notification', $notification);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->authorize('access', Post::class);
        try {
            $post = $this->postRepository->withTrashed()->find($id); // throw RepositoryException when can not found
            Storage::delete($post->image);
            $post->forceDelete();

            $message = trans('admin.post.delete.message.delete_success');
            $notification = [
                'message' => $message,
                'type' => 'success',
            ];
        } catch (RepositoryException $e) {
            $message = trans('admin.post.delete.message.not_found');
            $notification = [
                'message' => $message,
                'type' => 'danger',
            ];
        } catch (QueryException $e) {
            $message = trans('admin.post.delete.message.delete_error');
            $notification = [
                'message' => $message,
                'type' => 'danger',
            ];
        }

        return redirect()->back()->with('notification', $notification);
    }

    private function upload(Request $request, $directory, $directoryWithDate = true)
    {
        if ($request->hasFile('image')) {
            if ($directoryWithDate) {
                $directory .= date('/Y/m/d');
            }

            $fileName = str_slug($request->title) . '-' . time() . '.' . $request->image->extension();

            return $request->image->storeAs($directory, $fileName);
        }

        return null;
    }
}
