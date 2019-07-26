<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Employer extends Model
{
    use SoftDeletes;

    protected $table = 'employers';

    protected $primaryKey = 'id';

    protected $fillable = [
        "company_name",
        "dba",
        "address",
        "address2",
        "city",
        "state",
        "zipcode",
        "phone",
        "administrator_name",
        "administrator_phone",
        "administrator_email",
        "business_type",
        "license",
    ];

    public static function updateByUserId($profile)
    {
        return self::where('user_id', '=', $profile['user_id'])->whereNull('deleted_at')->update($profile);
    }

    public static function findByUserId($user_id)
    {
        return self::where('user_id', '=', $user_id)->whereNull('deleted_at')->first();
    }

    public function user()
    {
        return $this->BelongsTo('App\User');
    }

    public function shifts()
    {
        return $this->hasMany('App\Shift');
    }

}
