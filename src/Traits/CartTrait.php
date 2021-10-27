<?php

namespace Fermeturegarage\Dolivel\Traits;

use Illuminate\Support\Facades\Session;

trait CartTrait
{
	public function showCart()
	{
	//	return session()->get("cart");
    //  return session('cart');
        return Session::get('cart');
	}

	public function addToCart($id, $quantity = 1)
	{
		$cart = Session::get('cart'); // On récupère la session panier "cart"

		if (isset($cart[$id]) && $cart[$id]['quantity'] > 0) // On vérifie si l'article existe déjà
		{
			$quantity = $cart[$id]['quantity'] + $quantity; // On incrémente
		}
		else
		{
			$quantity = intval($quantity); // Sinon on ajoute
		}

        $cart[$id] = [
            'id' => $id,
            'quantity' => $quantity
        ];
	//	session()->put("cart", $cart); // On met à jour le panier
    Session::put('cart', $cart);

		return $cart;
	}

	public function removeFromCart($id, $quantity = false)
	{

	//	$cart = session()->get("cart");
		$cart = Session::get('cart');

		if (isset($cart[$id]) && ($quantity === false || $cart[$id]['quantity'] <= $quantity))
		{
			unset($cart[$id]);
			Session::put('cart', $cart);
		}
		elseif (isset($cart[$id]))
		{
			$cart[$id]['quantity'] = $cart[$id]['quantity'] - $quantity;
            Session::put('cart', $cart);
		}
		else
		{
			return false;
		}

		return true;
	}

	public function emptyTheCart()
	{
		// session()->forget("cart"); // On efface le panier
        Session::forget('cart');

		return true;
	}
}
