<?php



namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Support\Facades\Auth;
use DB;
use App\Models\UserMeta;
use App\Models\RequestMember;



class User extends Authenticatable

{

    use HasApiTokens, HasFactory, Notifiable;



    /**

     * The attributes that are mass assignable.

     *

     * @var array<int, string>

     */

    protected $fillable = [

        'full_name',
        'username',
        'tandc',
        'name',
        'email',
        'password',
        'member_id',
        'phone',
        'mobile',
        'gender',
        'dob',
        'admin_approve',
        'active_status',
        'profile_purpose'
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

    ];

    /**
     * get user roleauth user id
     */
    public function user_role()
    {
        $uid =  Auth::user()->id;
        $role= DB::table('users_roles')
            ->where('users_roles.user_id','=',$uid)
            ->join('role', 'users_roles.role_id', '=', 'role.id')
            ->select('role.name as name','role_id')
            ->first();
        return $role;
    }

    /**
     * get all user meta value by auth user id
     */
    public function getusermeta()
    {
        $uid =  Auth::user()->id;
        $usermeta = UserMeta::where(['user_id'=>$uid]);
        if($usermeta->count()>0){
            return $usermeta->first();
        }
        return false;
    }

    public function usermeta($id=''){
       
        $usermeta_detail = [];
        $personalmeta_detail = UserMeta::where(['user_id'=>$id])->first();
        if($personalmeta_detail->count()>0){
            $this->data['usermeta_detail'] = $personalmeta_detail->first(); 
        }
    }

    public function user_meta($id=''){
        return $this->hasOne('App\Models\UserMeta','user_id','id');

    }

    public function get_user_role($id=''){
        return $this->hasOne('App\Models\Auth\User\UserRole','user_id','id');
    }

    public function user_position(){
        return $this->hasOne('App\Models\Position','id','member_role');

    }

    public function likes()
    {
    return $this->hasMany('App\Models\LikeprofileModel', 'member_id','id');
    }

    public function friends()
    {
        // $instance =$this->belongsToMany('App\Models\RequestMember','to_member','id');
        // $instance->getQuery()->where('user_id','=', 'id');
        // return $instance;
        return $this->hasMany('App\Models\RequestMember', 'to_member','id');
    }
    
    

}

