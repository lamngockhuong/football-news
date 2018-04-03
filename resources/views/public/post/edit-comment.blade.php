<li class="sub-comment edit-comment">
    <ul>
        <li>
            <form class="row blog-comment" action="javascript:void(0)" data-url="{{ route('post.update-comment', ['post' => $comment->id]) }}">
                <div class="col-sm-12">
                    <div class="message">
                    </div>
                    <div class="form-group">
                        <textarea class="form-control style-d" rows="6" id="comment" placeholder="@lang('public.post.show.comment.content_placeholder')">{{ $comment->content }}</textarea>
                        <i class="fa fa-pencil-square-o"></i>
                    </div>
                </div>
                <div class="col-sm-3">
                    <button class="btn red-btn save-comment">
                        @lang('public.post.show.comment.edit_button')
                    </button>
                    <button class="btn cancel-edit-comment">
                        @lang('public.post.show.comment.cancel_button')
                    </button>
                </div>
            </form>
        </li>
    </ul>
</li>
