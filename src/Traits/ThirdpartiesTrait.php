<?php

namespace Dolivel\Traits;

trait ThirdpartiesTrait
{
	
	// Todo: affiche tous les client/prospect
	// Get a list of thirdparties
	// "thirdparties?sortfield=SORTFIELD&sortorder=SORTORDER&limit=LIMIT&page=PAGE&mode=MODE"
	public function getAllThirdparties($mode = 0, $limit = 100, $page = 0)
	{
		$sortfield = 't.rowid';
		$sortorder = 'ASC';
		
		$data = $this->getDolibarr('thirdparties?sortfield='.$sortfield.'&sortorder='.$sortorder.'&limit='.$limit.'&page='.$page.'&mode='.$mode);
		
		return $this->collectDolibarr($data);
	}
	
	// Todo: récupère les infos d'un client/prospect
	// Get properties of a thirdparty object
	// "thirdparties/ID"
	public function getThirdpartiesbyId($id)
	{
		$data = $this->getDolibarr('thirdparties/'.$id);
		
		return $this->collectDolibarr($data);
	}
	
	// Todo: création d'un client/prospect
	// Create thirdparty object
	// post /thirdparties
	public function postThirdparties()
	{
		$name = 'Client Laravel';
		$address = 'Allée des érables';
		$zip = '04200';
		$town = 'Sisteron';
		$phone = '06 05 04 03 01';
		$email = 'email@email.fr';
		$password = 'monmotdepassetest';
		
		// Sécurisation du mot de passe
		$password = password_hash($password, PASSWORD_DEFAULT);
		
		$data = array(
			'name' => $name,
		//	'namealias',
			'address' => $address,
			'zip' => $zip,
			'town' => $town,
			'phone' => $phone,
			'email' => $email,
		//	'idprof1', // SIREN
		//	'idprof2', // SIRET
		//	'idprof3', // NAF-APE
		//	'idprof4', // RCS/RM
			'client' => '2', // 1=>"Client", 2=>"Prospect", 3=>"Client/Psospect"
			'code_client' => '-1',
			'array_options' => array('options_password' => $password),
			'country' => 'France',
			'country_id' => '1',
			'country_code' => 'FR',
			'note_private' => 'Prospect du site',
		//	'note_public'
		);
		
		
		// Todo: on vérifie s'il existe déjà (=tel ou =email)
		$email_verif = $this->getThirdpartiesbyEmail($email);
		if (isset($email_verif['email']) && $email_verif['email'] == $email)
			// Todo: s'il existe retour ID
			return $email_verif['ref'];
			
		// Todo: création du client
		$data = $this->postDolibarr('thirdparties', json_encode($data));
		
		return collect($data);
		// Todo: si devis = prospect / commande = client
	}
	
	public function verifThirdpartiesPassword($email, $password)
	{
		// Todo: On vérifie si le client existe
		$client_data = $this->getThirdpartiesbyEmail($email);
		$client_data = $client_data->all();
		
		if (isset($client_data['error']))
		{
			// Si le client n'existe pas on retourne une erreur client
		}
			
			
		// Todo: On récupère le password hashé enregistré du client par email
	//	$password_hash = $client_data->pluck('array_options.options_password')->collapse();
		$password_hash = $client_data['array_options']['options_password'];
		
		// Todo: On compare le password reçu avec le hash enregistré
		if (password_verify($password, $password_hash))
		{
			// Todo: Si la vérification est correcte on return true
		}
		
		// Todo: On retourne une erreur password
	}
	
	// Todo: modification de la fiche client
	// Update thirdparty
	// put /thirdparties/{id} 
	
	// Todo: liste les réduction dispos du client
	// Get fixed amount discount of a thirdparty (all sources: deposit, credit note, commercial offers...)
	// get /thirdparties/{id}/fixedamountdiscounts 
	
	// Todo: récupère les infos d'un client par l'email
	// Get properties of a thirdparty object by email
	// get /thirdparties/email/EMAIL
	public function getThirdpartiesbyEmail($email)
	{
		$data = $this->getDolibarr('thirdparties/email/'.$email);
		
		return $this->collectDolibarr($data);
	}
	
}
