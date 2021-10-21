<?php

namespace Dolivel\Traits;

trait CartTrait
{
	public function showCart()
	{
		return session()->get("cart");
	}
	
	public function addToCart($product, $quantity = 1)
	{
		$cart = session()->get("cart"); // On récupère la session panier "cart"
		
		if (isset($cart[$product['id']]['quantity'])) // On vérifie si l'article existe déjà
		{
			$product['quantity'] = $cart[$product['id']]['quantity'] + $quantity; // On incrémente
		}
		else
		{
			$product['quantity'] = intval($quantity); // Sinon on ajoute
		}
		
		$cart[$product['id']] = $product; // On ajoute l'article
		session()->put("cart", $cart); // On met à jour le panier
		
		return $cart;
	}
	
	public function removeFromCart($id, $quantity = false)
	{

		$cart = session()->get("cart");
		
		if (isset($cart[$id]) && ($quantity === false || $cart[$id]['quantity'] <= $quantity))
		{
			unset($cart[$id]);
			session()->put("cart", $cart);
		}
		elseif (isset($cart[$id]))
		{
			$cart[$id]['quantity'] = $cart[$id]['quantity'] - $quantity;
		}
		else
		{
			return false;
		}
		
		return true;
	}
	
	public function emptyTheCart()
	{
		session()->forget("cart"); // On efface le panier
		
		return true;
	}
}
