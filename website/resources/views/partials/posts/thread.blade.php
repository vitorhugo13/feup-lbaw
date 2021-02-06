<div class="thread my-4" data-id="{{ $thread->id }}">
    @include('partials.comment.comment', ['comment' => $thread->comment, 'thread_id' => $thread->id, 'author' => $author])
    <div class="replies ml-5">
        @foreach ($thread->replies as $reply)
            @include('partials.comment.comment', ['comment' => $reply, 'thread_id' => $thread->id, 'author' => $author])
        @endforeach
    </div>
</div>