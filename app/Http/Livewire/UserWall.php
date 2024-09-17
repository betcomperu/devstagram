<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Post;

class UserWall extends Component
{
    public function render()
    {
        // Obtener las publicaciones que el usuario ha "liked"
        $likedPosts = Post::whereIn('id', function($query) {
            $query->select('post_id')
                  ->from('likes')
                  ->where('user_id', auth()->id());
        })->get();

        return view('livewire.user-wall', [
            'likedPosts' => $likedPosts, // Pasar la variable a la vista
        ]);
    }
}
