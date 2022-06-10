<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Response;

class UserService
{
    protected User $user;

    public function __construct(User $user)
    {
        $this->user = $user;
    }

    public function getUser(int $userId): User
    {
    }

    public function getUsers(): array
    {
    }

    public function createUser(array $userData): User
    {
        return $this->user->create([
            'name' => $userData['name'],
            'username' => $userData['username'],
            'email' => $userData['email'],
            'password' => Hash::make($userData['password']),
            'is_admin' => false
        ]);
    }

    public function updateUser(int $userId, array $userData): User
    {
        $user = $this->user->findOrFail($userId);

        $user->update([
            'name' => $userData['name'],
            'username' => $userData['username'],
            'email' => $userData['email']
        ]);

        return $user;
    }

    public function deleteUser(int $userId): bool
    {
        $user = $this->user->findOrFail($userId);

        return $user->delete();
    }

    public function restoreUser(int $userId): bool
    {
        $user = $this->user->onlyTrashed()->findOrFail($userId);

        return $user->restore();
    }

    public function restoreAll(): bool
    {
    }

    public function deleteUserRecycle(int $userId): bool
    {
        $user = $this->user->onlyTrashed()->findOrFail($userId);

        return $user->forceDelete();
    }

    public function deleteAllUserRecycle(): bool
    {
        $user = $this->user->onlyTrashed();

        // return $user->forceDelete();
        return $this->user->trashed() ? $user->forceDelete() :
            Response::json([
                'status' => 'error',
                'data' => "Tidak ada data di recycle bin"
            ]);
    }

    public function resetPassword(int $userId): bool
    {
        $user = $this->user->findOrFail($userId);

        return $user->update([
            'password' => Hash::make(1234567890),
        ]);
    }

    public function changeName(int $userId, string $name): bool
    {
        $user = $this->user->findOrFail($userId);

        return $user->update([
            'name' => $name,
        ]);
    }

    public function changeEmail(int $userId, string $email): bool
    {
        $user = $this->user->findOrFail($userId);

        return $user->update([
            'email' => $email,
        ]);
    }

    public function changePassword(int $userId, string $password): bool
    {
        $user = $this->user->findOrFail($userId);

        return $user->update([
            'password' => Hash::make($password),
        ]);
    }
}