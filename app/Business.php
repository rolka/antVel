<?php namespace app;

use App\User;
use App\Eloquent\Model;

class Business extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'businesses';
    public $timestamps = false;
    public $primaryKey  = 'user_id';
    public $incrementing = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [ 'user_id', 'business_name', 'creation_date' ];

    public static function create(array $attr = [], $normal=true)
    {
        $role=$normal?'Business':'Non Profit';
        if (!isset($attr['user_id'])&&isset($attr['user'])) {
            $attr['user']['role']=$role;
            $user=User::create($attr['user']);
            unset($attr['user']);
            $attr['user_id']=$user->id;
        }
        return parent::create($attr);
    }

    /**
     * Get business user
     * @return belongsTo
     */
    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function getAgeAttribute()
    {
        return \Carbon\Carbon::parse($this->creation_date)->age;
    }

    public function getHasPhoneAttribute()
    {
        return !is_null($this->local_phone);
    }
}
