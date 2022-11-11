<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Response;

class UserService
{
    /**
     * The model that represents with the service.
     *
     * @var App\Models\User
     */
    protected User $user;

    /**
     * Create a new service instance.
     *
     * @return void
     */
    public function __construct(User $user)
    {
        $this->user = $user;
    }

    /**
     * Create a new user.
     *
     * @param  array  $userData
     * @return App\Models\User
     */
    public function createUser(array $userData): User
    {
        return $this->user->create([
            'name' => $userData['name'],
            'username' => $userData['username'],
            'email' => $userData['email'],
            'password' => Hash::make($userData['password']),
            'is_admin' => false,
        ]);
    }

    /**
     * Update a user.
     *
     * @param  int  $userId
     * @param  array  $userData
     * @return App\Models\User
     */
    public function updateUser(int $userId, array $userData): User
    {
        $user = $this->user->findOrFail($userId);

        $user->update([
            'name' => $userData['name'],
            'username' => $userData['username'],
            'email' => $userData['email'],
        ]);

        return $user;
    }

    /**
     * delete a user.
     *
     * @param  int  $userId
     * @return bool
     */
    public function deleteUser(int $userId): bool
    {
        $user = $this->user->findOrFail($userId);

        return $user->delete();
    }

    /**
     * restore a user.
     *
     * @param  int  $userId
     * @return bool
     */
    public function restoreUser(int $userId): bool
    {
        $user = $this->user->onlyTrashed()->findOrFail($userId);

        return $user->restore();
    }

    /**
     * restore all users.
     *
     * @param  int  $userId
     * @return bool
     */
    public function restoreAll(): bool
    {
        $user = $this->user->onlyTrashed();

        return $user->restore();
    }

    /**
     * Delete a user permanently.
     *
     * @param  int  $userId
     * @return bool
     */
    public function deleteUserRecycle(int $userId): bool
    {
        $user = $this->user->onlyTrashed()->findOrFail($userId);

        return $user->forceDelete();
    }

    /**
     * Delete all users permanently.
     *
     * @param  int  $userId
     * @return bool
     */
    public function deleteAllUserRecycle(): bool
    {
        $user = $this->user->onlyTrashed();

        return $this->user->trashed() ? $user->forceDelete() :
            Response::json([
                'status' => 'error',
                'data' => 'Tidak ada data di recycle bin',
            ]);
    }

    /**
     * reset password a user.
     *
     * @param  int  $userId
     * @return bool
     */
    public function resetPassword(int $userId): bool
    {
        $user = $this->user->findOrFail($userId);

        return $user->update([
            'password' => Hash::make(1234567890),
        ]);
    }

    /**
     * Change name a user.
     *
     * @param  int  $userId
     * @param  string  $name
     * @return bool
     */
    public function changeName(int $userId, string $name): bool
    {
        $user = $this->user->findOrFail($userId);

        return $user->update([
            'name' => $name,
        ]);
    }

    /**
     * Change email a user.
     *
     * @param  int  $userId
     * @param  string  $email
     * @return bool
     */
    public function changeEmail(int $userId, string $email): bool
    {
        $user = $this->user->findOrFail($userId);

        return $user->update([
            'email' => $email,
        ]);
    }

    /**
     * Change password a user.
     *
     * @param  int  $userId
     * @param  string  $password
     * @return bool
     */
    public function changePassword(int $userId, string $password): bool
    {
        $user = $this->user->findOrFail($userId);

        return $user->update([
            'password' => Hash::make($password),
        ]);
    }
}
