<?php

namespace App\Repositories;

use Abedin\Boiler\Repositories\Repository;
use App\Enum\MediaTypeEnum;
use App\Http\Requests\UserStoreRequest;
use App\Http\Requests\UserUpdateRequest;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserRepository extends Repository
{
    public static function model()
    {
        return User::class;
    }

    public static function storeByRequest(UserStoreRequest $request)
    {
        $profilePicture = $request->hasFile('profile_picture') ? MediaRepository::storeByRequest(
            $request->file('profile_picture'),
            'user/profile_picture',
            MediaTypeEnum::IMAGE
        ) : $profilePicture = MediaRepository::storeByPath(
            public_path('media/blank-user.png'), // Path to default image
            'user/profile_picture',
            MediaTypeEnum::IMAGE
        );



        return self::create([
            'phone'    => $request->phone,
            'email'    => $request->email,
            'password' => Hash::make($request->password),
            'name'     => $request->name,
            'media_id' => $profilePicture ? $profilePicture->id : null,
        ]);
    }

    public static function updateByRequest(UserUpdateRequest $request, User $user)
    {
        if ($user->profilePicture) {
            $profilePicture = $request->hasFile('profile_picture') ? MediaRepository::updateByRequest(
                $request->file('profile_picture'),
                $user->profilePicture,
                'user/profile_picture',
                MediaTypeEnum::IMAGE
            ) : $user->profilePicture;
        } else {
            $profilePicture = $request->hasFile('profile_picture') ? MediaRepository::storeByRequest(
                $request->file('profile_picture'),
                'user/profile_picture',
                MediaTypeEnum::IMAGE
            ) : null;
        }

        return self::update($user, [
            'phone'    => $request->phone ?? $user->phone,
            'email'    => $request->email ?? $user->email,
            'password' => $request->password ? Hash::make($request->password) : $user->password,
            'name'     => $request->name ?? $user->name,
            'media_id' => $profilePicture ? $profilePicture->id : null,
        ]);
    }
}
