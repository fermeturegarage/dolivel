<?php

namespace Dolivel\Traits;

trait ProductsTrait
{
	
	/*	GET a list of products
	*	$category @long Use this param to filter list by category
	*	$limit @long Limit for list
	*	$page @long Page number
	*	"products?sortfield=t.ref&sortorder=ASC&limit=100&page=0&mode=1&category=0"
	*/
	public function getAllProducts($category = 1, $limit = 100, $page = 0)
	{
		$sortfield = 't.ref'; // Sort field
		$sortorder = 'ASC'; // Sort order
		$mode = 1; // 0 for all, 1 for only product, 2 for only service
		
		$data = $this->getDolibarr('products?sortfield='.$sortfield.'&sortorder='.$sortorder.'&limit='.$limit.'&page='.$page.'&category='.$category); // On récupère la liste des produits
		
		// Todo: Utiliser les collections de laravel
		if (!isset($data['error']))
		{
			foreach($data as $key => $value) // Pour chaque produit on ajoute une image
			{
				$image = $this->getDocumentsById($value['id']);
				if (isset($image['images'])) // Si une image est trouvée
				{
					$data[$key]['image'] = $image['images'][0];
				}
			}
		}
		
		return $this->collectDolibarr($data);
	}
	
	/*	GET properties of a product object by id
	*	$id @long ID of product
	*	"products/1"
	*/
	public function getProductById($id)
	{
		$data = $this->collectDolibarr(
			$this->getDolibarr('products/'.$id) // On récupère les infos du produit
		);
		
		
		if (!isset($data['error']))
		{
			$documents = $this->getDocumentsById($id);
			
			if ($documents->count() > 0)
			{
				foreach($documents as $key => $value)
				{
					$data->put($key, $value);
				}
			}
		}
		
		return $data;
	}
	
	/*	GET properties of a product object by ref
	*	$ref @string Ref of element
	*	"products/ref/REF"
	*/
	public function getProductByRef($ref)
	{
		$data = $this->getDolibarr('products/ref/'.$ref);
		
		return $this->collectDolibarr($data);
	}
	
	/*	GET categories for a product
	*	$id @long ID of product
	*	$limit @long Limit for list
	*	$page @long Page number
	*	"products/ID/categories?sortfield=SORTFIELD&sortorder=SORTORDER&limit=LIMIT&page=PAGE"
	*/
	public function getProductCategoriesById($id, $limit = 100, $page = 0)
	{
		$sortfield = 's.rowid'; // Sort field
		$sortorder = 'ASC'; // Sort order
		
		$data = $this->getDolibarr('products/'.$id.'/categories?sortfield='.$sortfield.'&sortorder='.$sortorder.'&limit='.$limit.'&page='.$page);
		
		return $this->collectDolibarr($data);
	}
	
	/* Verification of a product by ID and REF
	*	$id @long ID of product
	*	$ref @string Ref of element
	*/
	public function verifProductByIdRef($id, $ref)
	{
		$data = $this->getProductByRef($ref);
		
		if (isset($data['id']) && $data['id'] == $id)
		{
			return true;
		}
		else
		{
			return false;
		}
	}
}
