<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Post;
use App\Models\Like;

class LikeButton extends Component
{
    public $post; // Definir la propiedad
    public $isLiked = false; // Definir la propiedad isLiked

    public function mount(Post $post) // Asegúrate de pasar el modelo Post
    {
        $this->post = $post; // Inicializar la propiedad
        $this->isLiked = $this->post->likes()->where('user_id', auth()->id())->exists();
    }

    public function toggleLike()
    {
        if ($this->isLiked) {
            // Quitar el like
            Like::where('post_id', $this->post->id)->where('user_id', auth()->id())->delete();
        } else {
            // Dar like
            Like::create(['post_id' => $this->post->id, 'user_id' => auth()->id()]);
        }
        $this->isLiked = !$this->isLiked; // Alternar estado
    }

    public function render()
    {
        return view('livewire.like-button'); // No necesitas pasar likedPosts aquí
    }
}
