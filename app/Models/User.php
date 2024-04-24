<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use App\Filament\Traits\InputsTrait;
use BezhanSalleh\FilamentShield\Traits\HasPanelShield;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;
use Tymon\JWTAuth\Contracts\JWTSubject;
use Illuminate\Support\Str;
class User extends Authenticatable implements JWTSubject


{
  

    use HasApiTokens, HasFactory, Notifiable,  HasRoles, HasPanelShield;
    
   
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

    public function posts(){
        return $this->belongsToMany(Post::class,'post_users')->withTimestamps();
    }
    
    public function comments()
    {

        return $this->morphMany(Comment::class,'commentable');
    }

    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    /**
     * Return a key value array, containing any custom claims to be added to the JWT.
     *
     * @return array
     */
    public function getJWTCustomClaims()
    {
        return [];
    }


    public static function getForm() {
       
        return [
            
                Section::make()->schema([

                 InputsTrait::input('name',__('Name'),__('Enter Name'),'heroicon-m-user')->translateLabel(),
                 InputsTrait::input('email',__('Email'),__('Enter Email'),'heroicon-m-envelope')->translateLabel()->email()->unique(),
                 InputsTrait::input('password',__('Password'),__('Enter password'),'heroicon-m-Key')->translateLabel()->password()->revealable() ->hiddenOn(['edit','view']),
                 InputsTrait::select('roles',__('Roles'),'roles' ,'name')->translateLabel()
                 ->getSelectedRecordUsing(fn ($state): string =>Str::headline($state))
                 ->searchable(['name'])
                 ->hiddenOn('edit'),
               
                ]),
        ];
    }
}
