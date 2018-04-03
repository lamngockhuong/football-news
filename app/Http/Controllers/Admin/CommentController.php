<?php

namespace App\Http\Controllers\Admin;

use DB;
use Storage;
use Illuminate\Database\QueryException;
use App\Models\Comment;
use Illuminate\Http\Request;
use App\Http\Requests\CommentRequest;
use App\Exception\RepositoryException;
use App\Http\Controllers\Controller;
use App\Repositories\Contracts\PostRepositoryInterface;
use App\Repositories\Contracts\CommentRepositoryInterface;

class CommentController extends Controller
{
    protected $postRepository;
    protected $commentRepository;

    public function __construct(
        PostRepositoryInterface $postRepository,
        CommentRepositoryInterface $commentRepository
    ) {
        $this->postRepository = $postRepository;
        $this->commentRepository = $commentRepository;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $this->authorize('access', Comment::class);
        // q: query parameter
        $keyword = $request->q;
        $post = $request->post;
        $user = $request->user;

        if (isset($keyword)) {
            $comments = $this->commentRepository->search($keyword);
            $comments->appends($request->only('q'));
        } else {
            if (isset($post)) {
                $comments = $this->commentRepository->commentsByPost($post);
            } elseif (isset($user)) {
                $comments = $this->commentRepository->commentsByUser($user);
            } else {
                $comments = $this->commentRepository->comments();
            }
        }

        return view('admin.comment.index', compact('comments'));
    }

    public function active(Request $request)
    {
        $this->authorize('access', Comment::class);
        $comment = $this->commentRepository->find($request->id); // throw RepositoryException when can not found
        $this->commentRepository->update(['status' => (int) $request->status], $comment);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->authorize('access', Comment::class);
        try {
            $comment = $this->commentRepository->find($id); // throw RepositoryException when can not found
            $comment->delete();

            $message = trans('admin.comment.delete.message.delete_success');
            $notification = [
                'message' => $message,
                'type' => 'success',
            ];
        } catch (RepositoryException $e) {
            $message = trans('admin.comment.delete.message.not_found');
            $notification = [
                'message' => $message,
                'type' => 'danger',
            ];
        } catch (QueryException $e) {
            $message = trans('admin.comment.delete.message.delete_error');
            $notification = [
                'message' => $message,
                'type' => 'danger',
            ];
        }

        return redirect()->back()->with('notification', $notification);
    }
}
