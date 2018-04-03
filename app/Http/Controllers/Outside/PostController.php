<?php

namespace App\Http\Controllers\Outside;

use Exception;
use App\Http\Requests\CommentRequest;
use App\Exception\RepositoryException;
use App\Repositories\Contracts\PostRepositoryInterface;
use App\Repositories\Contracts\CommentRepositoryInterface;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PostController extends Controller
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

    public function show(Request $request)
    {
        try {
            $post = $this->postRepository->find($request->id);

            if ($post->slug !== $request->slug) {
                throw new RepositoryException();
            }

            $comments = $this->commentRepository->commentForPost($post->id);

            $nextPost = $this->postRepository->nextPost($post->id);
            $prevPost = $this->postRepository->prevPost($post->id);

            return view('public.post.show', compact('post', 'nextPost', 'prevPost', 'comments'));
        } catch (RepositoryException $e) {
            return view('errors.404');
        }
    }

    public function comment(CommentRequest $request, $id)
    {
        try {
            $this->postRepository->find($id);

            $inputs = $request->all();
            $inputs['post_id'] = $id;
            $inputs['user_id'] = auth()->user()->id;
            $comment = $this->commentRepository->create($inputs);
            $user = auth()->user();

            $message = trans('public.post.show.comment.message.comment_success');
            $notification = [
                'message' => $message,
                'html' => view('public.post.comment-detail', compact('user', 'comment'))->render(),
                'type' => 'success',
            ];
        } catch (RepositoryException $e) {
            $message = trans('public.post.show.comment.message.not_found');
            $notification = [
                'message' => $message,
                'type' => 'danger',
            ];
        }

        return response()->json($notification);
    }

    public function deleteComment($id)
    {
        try {
            $comment = $this->commentRepository->find($id);
            $user = auth()->user();
            if ($comment->user_id == $user->id || $user->is_admin) {
                $comment->delete();
            } else {
                throw new Exception();
            }

            $message = trans('public.post.show.comment.message.delete_success');
            $notification = [
                'message' => $message,
                'type' => 'success',
            ];
        } catch (Exception $e) {
            $message = trans('public.post.show.comment.message.not_found');
            $notification = [
                'message' => $message,
                'type' => 'danger',
            ];
        }

        return response()->json($notification);
    }

    public function editComment($id)
    {
        try {
            $user = auth()->user();
            $comment = $this->commentRepository->find($id);
            
            if ($comment->user_id == $user->id || $user->is_admin) {
                $message = trans('public.post.show.comment.message.delete_success');
                $notification = [
                    'message' => $message,
                    'html' => view('public.post.edit-comment', compact('comment'))->render(),
                    'type' => 'success',
                ];
            } else {
                throw new Exception();
            }
        } catch (Exception $e) {
            dd($e);
            $message = trans('public.post.show.comment.message.not_found');
            $notification = [
                'message' => $message,
                'type' => 'danger',
            ];
        }

        return response()->json($notification);
    }

    public function updateComment(CommentRequest $request, $id)
    {
        try {
            $comment = $this->commentRepository->find($id);

            $user = auth()->user();
            if ($comment->user_id == $user->id || $user->is_admin) {
                $comment['content'] = $request->content;
                $this->commentRepository->update($request->only('content'), $comment);
            } else {
                throw new Exception();
            }

            $message = trans('public.post.show.comment.message.update_comment_success');
            $notification = [
                'message' => $message . $comment->id,
                'html' => view('public.post.comment-detail-for-update', compact('user', 'comment'))->render(),
                'type' => 'success',
            ];
        } catch (RepositoryException $e) {
            $message = trans('public.post.show.comment.message.not_found');
            $notification = [
                'message' => $message,
                'type' => 'danger',
            ];
        }

        return response()->json($notification);
    }
}
