<div id="comment-area">
    <textarea id="comment-content" placeholder="Leave a comment!" oninput="auto_grow(this)"></textarea>
    <div class="d-flex flex-row justify-content-end">
        <button id="cancel-btn">Cancel</button>
        <button id="post-btn" data-id="{{ $id }}">Post</button>
    </div>
</div>