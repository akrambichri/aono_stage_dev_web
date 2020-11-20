<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Equipe extends Model
{
    use HasFactory;
    use SoftDeletes;

    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';

    protected $dateFormat = 'yyyy-MM-ddThh:mm:ss.SSS';

    protected $dates = ['deleted_at','created_at','updated_at','match_date'];

    protected $fillable = [
    'team_name', 'record'
     ];

    protected $hidden = ['MatchesIfFirst','MatchesIfSecond'];

        /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'team_name' => 'required',
        'record' => 'required'
    ];

    public function MatchesIfFirst()
    {
        return $this->hasMany('App\Models\Match' , "first_team_id");
    }

    public function MatchesIfSecond()
    {
        return $this->hasMany('App\Models\Match' , "second_team_id");
    }

    public function getUpComingMatchAttribute()
    {
        $data = $this->MatchesIfFirst->merge($this->MatchesIfSecond);
        $data = $data->unique();
        return $data->values()->sortByDesc("match_date")->first();
    }


}
