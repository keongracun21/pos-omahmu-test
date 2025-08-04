<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * Nama tabel (jika berbeda dengan konvensi Laravel)
     */
    protected $table = 'users';

    /**
     * Primary key custom
     */
    protected $primaryKey = 'user_id';

    /**
     * Nonaktifkan remember_token karena tidak ada kolomnya
     */
    public function getRememberTokenName()
    {
        return null; // Matikan remember token
    }

    /**
     * Kolom yang bisa diisi
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role'
    ];

    /**
     * Kolom yang disembunyikan
     */
    protected $hidden = [
        'password' // Hanya sembunyikan password
    ];

    /**
     * Timestamps tidak digunakan
     */
    public $timestamps = false;
}
