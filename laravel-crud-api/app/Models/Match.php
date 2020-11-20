<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Match extends Model
{
    use HasFactory;
    use SoftDeletes;

    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';

    //protected $dateFormat = 'yyyy-MM-ddThh:mm';

    protected $dates = ['deleted_at','created_at','updated_at','match_date'];

    protected $fillable = [
    'location', 'score','match_date','first_team_id','second_team_id'
     ];

    protected $hidden = ['first_team_id','second_team_id'];

        /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'location' => 'required',
        'match_date' => 'required',
        'first_team_id' => 'required',
        'second_team_id' => 'required',
    ];

    public function getMatchDateAttribute($date)
    {
        return Carbon::parse($date)->format('Y-m-d\TH:i');
    }

    public function FirstTeam()
    {
        return $this->belongsTo('App\Models\Equipe',"first_team_id");
    }

    public function SecondTeam()
    {
        return $this->belongsTo('App\Models\Equipe',"second_team_id");
    }

    public function scopeTeams($query)
    {
        return $query->with('FirstTeam', 'SecondTeam');
    }


}
