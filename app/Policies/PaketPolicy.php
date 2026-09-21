<?php
 
namespace App\Policies;
 
use App\Models\Paket;
use App\Models\User;
 
class PaketPolicy
{
    /**
     * CATATAN: aturan role di bawah ini menebak pola dari penggunaan
     * `auth()->user()->role_id === 1` di index.blade.php produk kamu.
     * Cek ProdukPolicy asli kamu dan samakan aturannya di sini kalau beda.
     */
 
    public function viewAny(User $user): bool
    {
        return true;
    }
 
    public function view(User $user, Paket $paket): bool
    {
        return true;
    }
 
    public function create(User $user): bool
    {
        return $user->role_id === 1;
    }
 
    public function update(User $user, Paket $paket): bool
    {
        return $user->role_id === 1;
    }
 
    public function delete(User $user, Paket $paket): bool
    {
        return $user->role_id === 1;
    }
}