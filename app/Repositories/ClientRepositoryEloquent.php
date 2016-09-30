<?php
/**
 * Created by PhpStorm.
 * User: rogerio
 * Date: 22/08/16
 * Time: 11:50
 */

namespace CodeProject\Repositories;

use CodeProject\Entities\Client;
use CodeProject\Presenters\ClientPresenters;
use Prettus\Repository\Eloquent\BaseRepository;

class ClientRepositoryEloquent extends BaseRepository implements ClientRepository
{

    public function model()
    {
        return Client::class;
    }

    public function presenter()
    {
        return ClientPresenters::class;
    }
}