<?php

namespace Fermeturegarage\Dolivel\Http\Controllers;

use Fermeturegarage\Dolivel\Facades\Calculator;
use Fermeturegarage\Dolivel\Facades\Dolivel;

class TestController extends Controller
{
    /**
     * TEST : Page d'accueil / Liste produits
     *
     * @param int $id
     * @return \Illuminate\Support\Collection $data
     */
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

    /**
     * TEST : Affiche détails d'un produit
     *
     * @param int $id
     * @param string $label
     * @return \Illuminate\Support\Collection $data
     */
	public function show($id = 0, $label = '')
	{
		$data = collect([]);

		$data->put('produit', $this->dolivel->getProductById($id, 'produit'));
		if (isset($data['produit']['error'])) return redirect('/');

		// Todo: return view('produit', $data);
	//	return view('produit', $data['produit']);
		return $data;
	}

    /**
     * TEST : Liste les catégories de 1er niveau
     *
     * @return \Illuminate\Support\Collection $data
     */
	public function catliste()
	{
		$data = collect([]);

		$request = $this->dolivel->getAllCategories('product');
		$data->put('categories', $request);

		// Todo: lister les produit de la catégorie principale

		return $data;
	}

    /**
     * TEST : Hello World
     *
     * @return view('dolivel::index')
     */
	public function hello()
	{
		$return = (object)[
			'hello' => 'Hello World de TestController',
			'nbr' => Calculator::add(100)->subtract(31)->getResult()
		];

		return view('dolivel::index', compact('return'));
	}

    /**
     * TEST : Utilisation du panier
     *
     * @return \Fermeturegarage\Dolivel\Api->showCart()
     */
	public function cart()
	{
        Dolivel::emptyTheCart();
        Dolivel::addToCart('Nouveau produit');
        Dolivel::addToCart('Rideaux', 2);
        Dolivel::addToCart('Rideaux', 3);
        return Dolivel::showCart();
     }
}
