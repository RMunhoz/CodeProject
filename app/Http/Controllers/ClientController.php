<?php

namespace CodeProject\Http\Controllers;

use CodeProject\Repositories\ClientRepository;
use Illuminate\Http\Request;


class ClientController extends Controller
{
    /**
     * @var ClientRepository
     */
    private $repository;

    public function __construct(ClientRepository $repository)
    {
        $this->repository = $repository;
    }

    public function index()
    {
        return $this->repository->all();
    }

    public function store(Request $request)
    {
        return $this->repository->create($request->all());
    }

    public function show($id)
    {
        return $this->repository->find($id);
    }

    public function destroy($id)
    {
        if($this->repository->find($id)->delete())
        {
            return response()->json(['Client deletado com sucesso']);
        }
        return response()->json(['Client não encontrado']);
    }

    public function update(Request $request, $id)
    {
        $this->repository->find($id)->update($request->all());
        return $this->repository->find($id);
    }
}
