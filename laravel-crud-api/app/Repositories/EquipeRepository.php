<?php

namespace App\Repositories;

use App\Models\Equipe;
use App\Repositories\BaseRepository;

/**
 * Class EquipeRepository
 * @package App\Repositories
 * @version Nov 19, 2020, 12:01 pm UTC
*/

class EquipeRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'team_name', 'record'
    ];

    /**
     * Return searchable fields
     *
     * @return array
     */
    public function getFieldsSearchable()
    {
        return $this->fieldSearchable;
    }

    /**
     * Configure the Model
     **/
    public function model()
    {
        return Equipe::class;
    }
}
