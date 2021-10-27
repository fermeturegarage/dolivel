<?php

namespace Dolivel\Controllers;

use Illuminate\Http\Request;

class ClientController extends Controller
{
    /* On redirige vers la connexion */
    public function index()
    {
		return "Todo: redirection à faire";
    }

    /* Formulaire nouveau client*/
    public function create()
    {
        //
    }

    /* Création nouveau client */
    public function store(Request $request)
    {
        //
    }

    /* Affichage client */
    public function show($id)
    {
		return $this->getDolibarr('thirdparties/'.$id, 'client');
    }

    /* Formulaire modification client */
    public function edit($id)
    {
        //
    }

    /* Update modification client*/
    public function update(Request $request, $id)
    {
        //
    }
}
