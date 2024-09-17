<div>
    <h2>Publicaciones que has "liked"</h2>
    @if($likedPosts->isEmpty())
        <p>No has dado "like" a ninguna publicación aún.</p>
    @else
        @foreach($likedPosts as $post)
            <div class="post">
                <h3>{{ $post->user->name }}</h3>
                <p>{{ $post->content }}</p>
                <p>❤️ ({{ $post->likes()->count() }})</p>
            </div>
        @endforeach
    @endif
</div>
