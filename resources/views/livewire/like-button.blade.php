<div>
    <button wire:click="toggleLike" class="{{ $isLiked ? 'text-red-500' : 'text-white opacity-50' }} px-4 py-2 rounded">
        ❤️ {{ $post->likes()->count() }}Likes <!-- Mostrar el conteo de likes -->
    </button>
</div>
