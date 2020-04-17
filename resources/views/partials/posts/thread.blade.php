<div class="thread my-4">
    @include('partials.posts.comment', ['comment' => $thread->comment])
    <div class="replies ml-5">
        @each('partials.posts.comment', $thread->replies, 'comment')
    </div>
</div>