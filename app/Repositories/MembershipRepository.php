<?php
/*
 * File name: CategoryRepository.php
 * Last modified: 2021.01.31 at 14:03:57
 * Author: SmarterVision - https://codecanyon.net/user/smartervision
 * Copyright (c) 2021
 */

namespace App\Repositories;

use App\Models\Membership;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class CategoryRepository
 * @package App\Repositories
 * @version January 19, 2021, 2:04 pm UTC
 *
 * @method Category findWithoutFail($id, $columns = ['*'])
 * @method Category find($id, $columns = ['*'])
 * @method Category first($columns = ['*'])
 */
class MembershipRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'id',
        'title',
        'cost',
        'discount',
        'validity_months',
        'thumbnail',
        'order',
        'created_by',
        'updated_by',
        
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return  Membership::class;
    }
}
