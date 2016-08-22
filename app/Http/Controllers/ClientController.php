<?php

namespace CodeProject\Http\Controllers;

use CodeProject\Client;
use Illuminate\Http\Request;
use CodeProject\Http\Requests;
use PhpSpec\Exception\Exception;


class ClientController extends Controller
{
    public function index()
    {
        return Client::all();
    }

    public function store(Request $request)
    {
        Client::create($request->all());
        return response()->json(['Client não encontrado']);
    }

    public function show($id)
    {
        return Client::find($id);
    }

    public function destroy($id)
    {
        if(Client::find($id)->delete())
        {
            return response()->json('Client deletado com sucesso');
        }
        return response()->json(['Client não encontrado']);
    }

    public function update($id, Request $request)
    {
        Client::find($id)->update($request->all());
        return Client::find($id);
    }
}
