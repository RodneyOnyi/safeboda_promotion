<?php

namespace App\Models;

use App\Models\GarageClient;


use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

use Tymon\JWTAuth\Contracts\JWTSubject;

class User extends Authenticatable implements JWTSubject
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * Get the identifier that will be stored in the subject claim of the JWT.
     *
     * @return mixed
     */
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

    public function view($role)
    {
        $garageId =  self::userGarage();
        return User::leftjoin('rights_group', 'rights_group.id', '=', 'users.rights_group')
            ->select('users.*', 'rights_group.name AS group')
            ->when($role, function ($query) use ($role) {
                return $query->where('role', '=', $role);
            })
            ->when($garageId, function ($query) use ($garageId) {
                return $query->where('users.garage_id', '=', $garageId);
            })
            ->get();
    }

    public function add($request)
    {
        $user = new User;
        $user->first_name = request('first_name');
        $user->middle_name = request('middle_name') ? request('middle_name') : null;
        $user->last_name = request('last_name');
        $user->email = request('email');
        $user->password = Hash::make(request('password'));
        $user->garage_id = request('garage') ? request('garage') : 0;
        $user->rights_group = request('rights_group');
        $user->save();

        if ($user && $user->rights_group == 4) {
            GarageClient::add($user);
        }

        return $user;
    }

    public function updateUser($request, $user)
    {
        $user->first_name = request('first_name');
        $user->middle_name = request('middle_name') ? request('middle_name') : null;
        $user->last_name = request('last_name');
        $user->rights_group = request('rights_group');
        $user->save();

        return $user;
    }

    public function deleteUser($request)
    {
        $user = User::find(request('user_id'));
        $user->status = 0;
        $user->save();

        return $user;
    }

    public function users_monthly()
    {
        $garageId =  self::userGarage();
        $data =  User::select(DB::raw('MONTHNAME(created_at) AS month, COUNT(id) AS clients'))
            ->where(DB::raw('YEAR(created_at)'), '=', now()->year)
            ->where('rights_group', '=', 4)
            ->where('status', '=', 1)
            ->when($garageId, function ($query) use ($garageId) {
                return $query->where('garage_id', '=', $garageId);
            })
            ->groupBy('month')
            ->orderBy(DB::raw('str_to_date(MONTH,"%M")'))
            ->get();

        $months = array();
        $clients = array();

        foreach ($data as $value) {
            array_push($months, $value->month);
            array_push($clients, $value->clients);
        }

        return ['months' => $months, 'data' => $clients];
    }


    public function search($request, $role)
    {
        $garageId = self::userGarage();
        $users = [];

        $users = User::where('status', 1)
            ->when($garageId, function ($query) use ($garageId) {
                return $query->where('garage_id', '=', $garageId);
            })
            ->when($request->has('q'), function ($query) use ($request) {
                return $query->where('first_name', 'LIKE', "%$request->q%")->orWhere('last_name', 'LIKE', "%$request->q%");
            })
            ->when($role, function ($query) use ($role) {
                return $query->where('rights_group', $role);
            })
            ->get();

        return response()->json($users);
    }

    public static function userGroup()
    {
        return auth()->user() ? auth()->user()->rights_group : (auth('api')->user() ? auth('api')->user()->rights_group : 0);
    }
}
