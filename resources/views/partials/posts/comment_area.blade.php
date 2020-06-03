<div id="comment-area">
    @guest
        <div id="comment-area-overlay" class="d-flex flex-column justify-content-center align-items-center">
            <p>To leave a comment please</p>
            <p><a href="{{ route('login') }}">Log In</a> or <a href="{{ route('register') }}">Register</a></p>
        </div>
    @endguest
    <textarea id="comment-content" placeholder="Leave a comment!" oninput="auto_grow(this)"></textarea>
    <div class="d-flex flex-row justify-content-end">
        <button id="cancel-btn">Cancel</button>
        <button id="post-btn" data-post-id="{{ $id }}">Comment</button>
    </div>
</div>