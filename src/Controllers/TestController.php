<?php

namespace App\Http\Controllers;

class TestController extends DolivelController
{
	/* Page d'accueil */
	// Todo
    /* Liste des Produits */
    public function index($id = 1)
    {
		
		$data = collect([]); // On crée la collection
		
		$request = $this->dolivel->getAllProducts($id); // On fait la requête API
	//	if (isset($request['error'])) // On vérifie les erreurs
	//	{
	//		return redirect('produits'); // On traite les erreurs
	//	}
		$data->put('produits', $request); // Sinon on ajoute à la collection
		
		$request = $this->dolivel->getCategorieById($id, true);
		$data->put('categories', $request);
		
//		return view('produit');
		return $data;
    }
	
	/* Affiche détails d'un produit */
	// Todo
	/* Fonction de test */
	public function show($id = 0, $label = '')
	{
		$data = collect([]);
		
		$data->put('produit', $this->dolivel->getProductById($id, 'produit'));
		if (isset($data['produit']['error'])) return redirect('/');
		
		// Todo: return view('produit', $data);
	//	return view('produit', $data['produit']);
		return $data;
	}
	
	/* Liste les catégories de 1er niveau */
	public function catliste()
	{
		$data = collect([]);
		
		$request = $this->dolivel->getAllCategories('product');
		$data->put('categories', $request);
		
		// Todo: lister les produit de la catégorie principale
		
		return $data;
	}
	
	
	
	
	
}
