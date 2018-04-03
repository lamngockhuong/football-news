<li>
    <img class="position-center-x" src="{{ $user->avatar_url }}" onerror='this.src="{{ asset(' images/no-image.png
        ') }}"' width="80" height="80">
    <div class="comment-detail">
        <h5><a href="#">{{ $user->name }}</a></h5>
        <span>{{ $comment->comment_date }}</span>
        <p>{{ $comment->content }}</p>
        @if ($user->id == $comment->user_id)
            <div class="comment-action">
                <a class="reply-btn edit-comment" href="javascript:void(0)" data-url='{{ route('post.edit-comment', ['comment' => $comment->id]) }}'>
                    <i class="fa fa-edit"></i>@lang('public.post.show.comment.edit')
                </a>
                <a class="reply-btn delete-comment" href="javascript:void(0)" data-url='{{ route('post.delete-comment', ['comment' => $comment->id]) }}'>
                    <i class="fa fa-times"></i>@lang('public.post.show.comment.delete')
                </a>
            </div>
        @endif
    </div>
</li>
