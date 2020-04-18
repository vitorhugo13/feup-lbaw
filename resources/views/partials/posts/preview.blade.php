<div class="post-preview">
    <header>
        <div>
        <a class="title" href="{{url('posts/' . $post->id)}}">{{$post->title}}</a>
            <span class="by">
                by <a class="author" href="{{url('users/' . $post->content->owner->id)}}">{{$post->content->owner->username}}</a>
            </span>
        </div>
        @include('partials.posts.star', ['post' => $post])
    </header>
    <div class="content">
        <!--TODO: newlines/ format text-->
        <p>{{ $post->content->body }}</p>
    </div>
    <footer>
        <div class="votes">
            @include('partials.content.rating', ['content' => $post->content])
        </div>
    <div class="comments"><i class="far fa-comment"></i>{{ $post->num_comments }}</div>
    </footer>
</div>