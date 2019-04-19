<?php

namespace App\Repositories;

use App\Models\Organisation;
use App\Contracts\OrganisationsRepo;

class OrganisationsRepoWorker implements OrganisationsRepo
{
    /**
     * Add new organisation to DB
     *
     * @param  $name string
     *
     * @return int
     *
     * @throws
     *
     *
     *  */
    public function add($name) : int
    {
        $org = new Organisation();
        $org->name = $name;
        $org->save();

        return $org->id;
    }
}
