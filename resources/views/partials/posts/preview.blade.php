<div class="post-preview">
    <header>
        <div>
        <a class="title" href="{{url('posts/' . $post->id)}}">{{$post->title}}</a>
            <span class="by">
                by <a class="author" href="{{url('users/' . $post->content->owner->id)}}">{{$post->content->owner->username}}</a>
            </span>
        </div>
        <!--TODO: check if user has starred the post-->
        <label class="checkbox-label">
            <input type="checkbox" id="star-category">
            <i class="unchecked far fa-star"></i>
            <i class="checked fas fa-star"></i> 
        </label>
    </header>
    <div class="content">
        <!--TODO: newlines/ format text-->
        <p>{{$post->content->body}}</p>
    </div>
    <footer>
        <div class="votes">
        <div class="upvotes"><img src="{{asset('images/hoof_filled.svg')}}" width="13" alt="uphoof" />+{{$post->content->upvotes}}</div>
        <div class="downvotes"><img src="{{asset('images/hoof_outline.svg')}}" width="13" alt="downhoof" />-{{$post->content->downvotes}}</div>
        </div>
    <div class="comments"><i class="far fa-comment"></i>{{$post->num_comments}}</div>
    </footer>
</div>