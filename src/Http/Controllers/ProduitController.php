<?php

namespace Fermeturegarage\Dolivel\Http\Controllers;

use Fermeturegarage\Dolivel\Facades\Dolivel;

class ProduitController extends Controller
{
    /**
     * TODO: Page d'accueil
     *
     * @param int $id Id de la catégorie Dolibarr à afficher
     * @return \Illuminate\Support\Collection->collect() $data
     */
    public function index($id = 1)
    {
		$data = collect([]); // On crée la collection

		$request = Dolivel::getAllProducts($id); // On fait la requête API
	//	if (isset($request['error'])) // On vérifie les erreurs
	//	{
	//		return redirect('produits'); // On traite les erreurs
	//	}
		$data->put('produits', $request); // Sinon on ajoute à la collection

		$request = Dolivel::getCategorieById($id, true);
		$data->put('categories', $request);

		return $data;
    }

    /**
     * TODO: Affiche les informations d'un produit Dolibarr
     *
     * @param int $id Id du produit Dolibarr
     * @param string $label TODO
     * @return \Illuminate\Support\Collection->collect() $data
     */
	public function show($id = 0, $label = '')
	{
		$data = collect([]);

		$data->put('produit', Dolivel::getProductById($id, 'produit'));
		if (isset($data['produit']['error'])) return redirect('/');

		// Todo: return view('produit', $data);
		return $data;
	}

    /**
     * TODO: Liste les catégories de 1er niveau
     *
     * @return \Illuminate\Support\Collection->collect() $data
     */
	public function catliste()
	{
		$data = collect([]);

		$request = Dolivel::getAllCategories('product');
		$data->put('categories', $request);

		// Todo: lister les produit de la catégorie principale

		return $data;
	}
}
