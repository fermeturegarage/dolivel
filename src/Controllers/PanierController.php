<?php

namespace App\Http\Controllers;

class PanierController extends DolivelController
{
	public function index()
	{
		$data = collect([]); // On crée la collection
		
		$request = $this->dolivel->showCart();
		return $request;
	}
	
	public function add($id, $ref, $quantity = 1)
	{
		$produit = $this->dolivel->getProductById($id, 'produit');
		
		if (isset($produit['ref']) && $produit['ref'] == $ref)
		{
			$this->dolivel->addToCart($produit, $quantity);
			return redirect()->route("panier")->withMessage("Produit ajouté au panier");
		}
		
		return redirect()->route("panier")->withMessage("Le produit n'a pas pu être ajouté au panier");
	}
	
	public function remove($id, $quantity = false)
	{
		$return = $this->dolivel->removeFromCart($id, $quantity);
		
		if ($return)
		{
			return redirect()->route("panier")->withMessage("Produit enlevé du panier");
		}
		else
		{
			return redirect()->route("panier")->withMessage("Le produit n'a pas pu être supprimé");
		}
	}
	
	public function destroy()
	{
		$this->dolivel->emptyTheCart();
		
		return redirect()->route("panier")->withMessage("Le panier à été vidé");
	}
	
	public function save()
	{
		// Todo: Sauvegarder le panier
		return redirect()->route("panier");
	}
	
	public function load()
	{
		// Todo: Restaurer un panier
		return redirect()->route("panier");
	}
	
}
