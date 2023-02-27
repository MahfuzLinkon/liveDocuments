<?php

namespace App\Repositories;

use App\Exceptions\GeneralJsonException;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Throwable;

class UserRepository extends BaseRepository
{

    /**
     * @param array $attribute
     * @return mixed
     */
    public function create(array $attribute)
    {
        return DB::transaction(function () use ($attribute){
            $created = User::query()->create([
                'name' => data_get($attribute, 'name'),
                'email' => data_get($attribute, 'email'),
                'password' => Hash::make(data_get($attribute, 'password')),
            ]);
            throw_if(!$created,GeneralJsonException::class, 'User not created');
            return $created;
        });
    }

    /**
     * @param $user
     * @param array $attribute
     * @return mixed
     */
    public function update($user, array $attribute)
    {
        return DB::transaction(function () use ($user, $attribute){
            $updated = $user->update([
                'name' => data_get($attribute, 'name', $user->name),
                'email' => data_get($attribute, 'email', $user->email),
            ]);
            throw_if(!$updated,GeneralJsonException::class, 'User not updated');
            return $updated;
        });
    }


    /**
     * @param $user
     * @return mixed
     * @throws Throwable
     */
    public function forceDelete($user)
    {
        $delete = $user->forceDelete();
        throw_if(!$delete, GeneralJsonException::class, 'User not deleted');
        return $delete;
    }
}
