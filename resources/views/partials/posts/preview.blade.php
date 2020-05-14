<div class="post-preview">
    <header>
        <div>
        <a class="title" href="{{url('posts/' . $post->id)}}">{{$post->title}}</a>
            <span class="by">
                by @if($post->content->owner != null) <a class="author"  href="{{url('users/' . $post->content->owner->id)}}">{{$post->content->owner->username}}</a>
                @else
                <a class="author"  href="">anon</a>
                @endif
            </span>
        </div>
        @include('partials.posts.star', ['post' => $post])
    </header>
    <div class="content">
        <a href="{{url('posts/' . $post->id)}}" style="text-decoration: none; color:var(--foreground);"><p>{{ $post->content->body }}</p></a>
    </div>
    <footer>
        <div class="votes">
            @include('partials.content.rating', ['content' => $post->content])
        </div>
    <div class="comments"><i class="far fa-comment"></i>{{ $post->num_comments }}</div>
    </footer>
</div>
