<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends \TCG\Voyager\Models\User
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
        'role_id',
        'settings',
        'porcentage_gain'
    ];

    public const FRANQUEADO = '2';

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
    ];

    public function scopeGetZipCodesByUser(object $query): object
    {
        $query = $query->select(['locations.zip_code_start', 'locations.zip_code_end']);
        if (verifyUserLogged()
            and !getUserLoggedIsAdmin()
            and !getUserLoggedIsAdmin()
            ) {
            $query = $query->where('users.id', getUserLoggedId());
        }
        $query = $query->join('user_locations', 'users.id', 'user_locations.user_id')
            ->join('locations', 'locations.id', 'user_locations.location_id')
            ->get();
        return $query;
    }

    public function scopeRetrieveMailAndIdFranqueado(object $query) : array
    {
        $query = $query->select(['id','name','email']);
        if(getUserLoggedIsAdmin()){
            $query = $query->where('role_id',self::FRANQUEADO);
        }else{
            $query = $query->where('id',getUserLoggedId());
        }
        $query = $query->get()->toArray();
        if(getUserLoggedIsAdmin()){
            $query[] = array('id'=>'','name'=>'Todos franqueados','email'=>'Todos franqueados');
            $query[] = array('id'=>'no','name'=>'Nenhum franqueado','email'=>'Nenhum franqueado');
        }
        return $query;
    }

    public function customerZipCodes(): BelongsToMany
    {
        return $this->belongsToMany(
            User::class,
            'user_locations',
            'location_id',
            'user_id'
        );
    }
}
