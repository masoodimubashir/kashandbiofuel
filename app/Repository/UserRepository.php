<?php

namespace App\Repository;

use App\Models\User;

class UserRepository extends BaseRepository
{
    /**
     * Create a new class instance.
     */
    public function __construct(User $model)
    {
        parent::__construct($model);
    }
}
