<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;
use Laravel\Passport\Token;
use App\Classes\StatusCodes;
use Illuminate\Support\Facades\Hash;
use App\DataTransferObjects\LoginData;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public function login(string $password): LoginData
    {
        if (Hash::check($password, $this->password)) {
            $token      = $this->createToken('My Token')->accessToken;
            $statusCode = StatusCodes::$OK;            
        } else {
            $statusCode = StatusCodes::$UNAUTHORIZED;
            $token      = null;
        }

        $result = new LoginData($token, $statusCode);
        return $result;
    }

    public static function getByToken($token): User
    {
        $token_parts = explode('.', $token);
        $token_header = $token_parts[1];
        $token_header_json = base64_decode($token_header);
        $token_header_array = json_decode($token_header_json, true);
        $token_id = $token_header_array['jti'];

        return Token::find($token_id)->user;
    }
}
