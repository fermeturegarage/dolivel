<?php

namespace Dolivel\Controllers;

use Illuminate\Http\Request;

class CategorieController extends Controller
{
    /* Liste des catégories */
    public function index()
    {
		return $this->getDolibarr('categories?sortfield=t.rowid&sortorder=ASC&limit=100');
		return "Todo: Liste des catégories";
    }

    /* Catégorie par ID */
    public function show($id)
    {
		// On récupère les infos de la catégorie
		$data = $this->getDolibarr('categories/'.$id);
		
		// S'il n'y a pas d'enregistrement on redirige vers une URL
		if ($data === false) {
			return redirect('categorie');
		}
		
		// Sinon on traite
		else {
			// On récupère des données supplémentaires
			$data['documents'] = $this->getDolibarr('documents?modulepart=categorie&id='.$id);
			
			// On redirige vers la vue
			return view('categorie', $data);
		}
    }
}
