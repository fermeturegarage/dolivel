<?php

namespace Dolivel\Traits;

trait CategoriesTrait
{
	
	/*	GET a list of categories
	*	@param string $type Type of category ('member', 'customer', 'supplier', 'product', 'contact')
	*	@param long $limit Limit for list
	*	@param long $page Page number
	*	@request "categories?sortfield=SORTFIELD&sortorder=SORTORDER&limit=LIMIT&page=PAGE&type=TYPE"
	*	@return array
	*/
	public function getAllCategories($type = 'product', $limit = 100, $page = 0)
	{
		$sortfield = 't.rowid'; // Sort field
		$sortorder = 'ASC'; // Sort order
		
		$data = $this->getDolibarr('categories?sortfield='.$sortfield.'&sortorder='.$sortorder.'&limit='.$limit.'&page='.$page.'&type='.$type);
		
		return $this->collectDolibarr($data);
	}
	
	
	/*	GET properties of a category object
	*	$id @long ID of category
	*	$include_childs @boolean Include child categories list (true or false)
	*	"categories/ID?include_childs=CHILDS"
	*/
	public function getCategorieById($id, $include_childs = false)
	{
		$data = $this->getDolibarr('categories/'.$id.'?include_childs='.$include_childs);
		
		return $this->collectDolibarr($data);
	}
	
	
	/*	GET the list of objects in a category
	*	$id @long ID of category
	*	$type @string Type of category ('member', 'customer', 'supplier', 'product', 'contact', 'project')
	*	$onlyids @long Return only ids of objects (consume less memory)
	*	"categories/ID/objects?type=TYPE&onlyids=ONLYIDS"
	*/
	public function getCategorieObjectsById($id, $type = 'product', $onlyids = false)
	{
		$data = $this->getDolibarr('categories/'.$id.'/objects?type='.$type.'&onlyids='.$onlyids);
		
		return $this->collectDolibarr($data);
	}
	
	/*	GET the list of categories linked to an object
	*	$id @long Object ID
	*	$type @string Type of category ('member', 'customer', 'supplier', 'product', 'contact', 'project')
	*	$limit @long Limit for list
	*	$page @long Page number
	*	"categories/object/TYPE/ID?sortfield=SORTFIELD&sortorder=SORTORDER&limit=LIMIT&page=PAGE"
	*/
	public function getProductCategories($id, $type = 'product', $limit = 100, $page = 0)
	{
		$sortfield = 't.rowid'; // Sort field
		$sortorder = 'ASC'; // Sort order
		
		$data = $this->getDolibarr('categories/object/'.$type.'/'.$id.'?sortfield='.$sortfield.'&sortorder='.$sortorder.'&limit='.$limit.'&page='.$page);
		
		return $this->collectDolibarr($data);
	}
}
