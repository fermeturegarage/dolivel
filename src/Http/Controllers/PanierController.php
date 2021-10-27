<?php

namespace Fermeturegarage\Dolivel\Http\Controllers;

use Fermeturegarage\Dolivel\Facades\Dolivel;

class PanierController extends Controller
{
	/**
	 * Affiche les informations du panier
	 *
	 * @return \Fermeturegarage\Dolivel\Api showCart()
	 */
	public function index()
	{
		$data = collect([]); // On crée la collection

		return Dolivel::showCart();
	}

	/**
	 * Ajoute un produit au panier
	 *
	 * @param string $id Id Dolibarr du produit
	 * @param string $ref Ref Dolibarr du produit
	 * @param int $quantity
	 * @return \Illuminate\Routing\Redirector redirect()
	 */
	public function add($id, $ref, $quantity = 1)
	{
		$produit = Dolivel::getProductById($id, 'produit');

		if (isset($produit['ref']) && $produit['ref'] == $ref)
		{
			Dolivel::addToCart($produit, $quantity);
			return redirect()->route("panier")->withMessage("Produit ajouté au panier");
		}

		return redirect()->route("panier")->withMessage("Le produit n'a pas pu être ajouté au panier");
	}

	/**
	 * Enlève une quantité d'un produit du panier
	 *
	 * @param int $id Id Dolibarr du produit
	 * @param int $quantity Quantité à enlever du produit
	 * @return \Illuminate\Routing\Redirector redirect()
	 */
	public function remove($id, $quantity = false)
	{
		$return = Dolivel::removeFromCart($id, $quantity);

		if ($return)
		{
			return redirect()->route("panier")->withMessage("Produit enlevé du panier");
		}
		else
		{
			return redirect()->route("panier")->withMessage("Le produit n'a pas pu être supprimé");
		}
	}

	/**
	 * Supprime le contenu du panier
	 *
	 * @return \Illuminate\Routing\Redirector redirect()
	 */
	public function destroy()
	{
		Dolivel::emptyTheCart();

		return redirect()->route("panier")->withMessage("Le panier à été vidé");
	}

    /**
     * TODO : Sauvegarder le panier
     *
	 * @return \Illuminate\Routing\Redirector redirect()
     */
	public function save()
	{
		return redirect()->route("panier");
	}

    /**
     * TODO : Restaurer un panier
     *
	 * @return \Illuminate\Routing\Redirector redirect()
     */
	public function load()
	{
		return redirect()->route("panier");
	}
}
