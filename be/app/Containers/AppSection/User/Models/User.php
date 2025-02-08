<?php

namespace App\Containers\AppSection\User\Models;

use App\Containers\AppSection\Authentication\Notifications\VerifyEmail;
use App\Containers\AppSection\Authentication\Traits\AuthenticationTrait;
use App\Containers\AppSection\Authorization\Traits\AuthorizationTrait;
use App\Containers\AppSection\Notification\Events\NotificationEvent;
use App\Containers\AppSection\User\Events\CreateUserEvent;
use App\Containers\AppSection\User\Notifications\DefaultNotification;
use App\Ship\Contracts\MustVerifyEmail;
use App\Ship\Parents\Models\UserModel as ParentUserModel;
use Illuminate\Notifications\Notifiable;
use Illuminate\Validation\Rules\Password;
use Laravel\Passport\RefreshTokenRepository;

class User extends ParentUserModel implements MustVerifyEmail
{
    use AuthorizationTrait;
    use AuthenticationTrait;
    use Notifiable;

    protected $fillable = [
        'name',
        'username',
        'email',
        'phone',
        'password',
        'gender',
        'birthday',
        'avatar',
        'address',
        'status',
        'social_provider',
        'social_nickname',
        'social_id',
        'social_token',
        'social_token_secret',
        'social_refresh_token',
        'social_expires_in',
        'social_avatar',
        'social_avatar_original',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [];

    protected $table = 'users';


    public static function getTableName()
    {
        return 'users';
    }

    protected static function booted()
    {
        static::created(function ($user) {
            CreateUserEvent::dispatch($user);
        });
    }

    public static function getPasswordValidationRules(): Password
    {
        return Password::min(5)
            ->letters()
            ->mixedCase()
            ->numbers()
            ->symbols();
    }

    public function sendEmailVerificationNotificationWithVerificationUrl(string $verificationUrl): void
    {
        $this->notify(new VerifyEmail($verificationUrl));
    }

    public static function logoutAuthByIdAllDevices($userId)
    {
        $user = static::find($userId);
        $refreshTokenRepository = app(RefreshTokenRepository::class);
        foreach ($user->tokens as $token) {
            $token->revoke();
            $refreshTokenRepository->revokeRefreshTokensByAccessTokenId($token->id);
        }
    }

    public function createNotify($title, $message)
    {
        $this->notify(new DefaultNotification($title, $message));
        NotificationEvent::dispatch($this->id, [
            'total' => $this->notifications->count(),
            'unread' => $this->unreadNotifications->count(),
            'type' => 'default',
            'title' => $title,
            'message' => $message,
        ]);
    }
}
