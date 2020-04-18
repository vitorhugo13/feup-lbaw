<div class="thread my-4" data-id="{{ $thread->id }}">
    @include('partials.posts.comment', ['comment' => $thread->comment, 'thread_id' => $thread->id])
    <div class="replies ml-5">
        @foreach ($thread->replies as $reply)
            @include('partials.posts.comment', ['comment' => $reply, 'thread_id' => $thread->id])
        @endforeach
        {{-- @each('partials.posts.comment', $thread->replies, 'comment') --}}
    </div>
</div>