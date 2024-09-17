<?php

namespace App\Models;

   use Illuminate\Database\Eloquent\Factories\HasFactory;
   use Illuminate\Foundation\Auth\User as Authenticatable;
   use Illuminate\Notifications\Notifiable;
   use Laravel\Sanctum\HasApiTokens;
   use Illuminate\Database\Eloquent\Relations\HasMany;

   class User extends Authenticatable
   {
       use HasApiTokens, HasFactory, Notifiable;

       protected $fillable = [
           'name',
           'email',
           'password',
           'username',
       ];

       protected $hidden = [
           'password',
           'remember_token',
       ];

       protected $casts = [
           'email_verified_at' => 'datetime',
           'password' => 'hashed',
       ];

       /**
        * Relación con el modelo Like.
        *
        * @return \Illuminate\Database\Eloquent\Relations\HasMany
        */
       public function likes(): HasMany
       {
           return $this->hasMany(Like::class);
       }
   }
