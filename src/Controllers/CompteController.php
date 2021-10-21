<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Socialite;
use App\User;

class CompteController extends DolivelController
{
	public function client(Request $request)
	{
	//	$input = $request->all();
	
		// Todo: A MODIFIER LA C'EST POUR TESTER !!!!!!!!
		return $this->dolivel->postThirdparties();
	}
	
	
	
	
	// Todo: index / Affiche les informations de compte
	public function index()
	{
		// Todo: fonction
	}
	
	// Todo: connexion / Connexion au compte client
	public function connexion()
	{
		// Todo: fonction
	}
	
	// Providers autorisés
	protected $providers = ['facebook', 'google', 'github', 'linkedin'];
	
	
	// Todo: socialiteRegister / La page où on présente les liens de redirection vers les providers
	// A SUPPRIMER
	public function socialiteRegister()
	{
		// Todo: fonction
		return view("connexion.login_register");
	}
	
	// Todo: socialiteRedirect / La redirection vers le provider
	public function socialiteRedirect(Request $request)
	{
		$provider = $request->provider;
		
		// On vérifie si le provider est autorisé
		if (in_array($provider, $this->providers))
		{
			return Socialite::driver($provider)->redirect(); // On redirige vers le provider
		}
		
		abort(404); // Si le provider n'est pas autorisé
	}
	
	// Todo: socialiteCallback / Le callback du provider
	public function socialiteCallback(Request $request)
	{
		$provider = $request->provider;
		
		if (in_array($provider, $this->providers))
		{
			// Les informations provenant du provider
			$data = Socialite::driver($request->provider)->user();
			
			// Les informations de l'utilisateur
			$id = $data->getId();
			$name = $data->getName();
			$nickname = $data->getNickname();
			$email = $data->getEmail();
			$avatar = $data->getAvatar();
			
			// Todo: Vérifie si le compte existe
				// Todo: S'il existe s'authentifier et éventuellement mettre à jour les informations du client
				// Todo: S'il n'existe pas on enregistre le nouveau client
				$user = User::create([
					'name' => $name,
					'email' => $email,
					'password' => bcrypt("emilie") // On attribue un mot de passe
				]);
				
				// Todo: On connecte le client
				auth()->login($user);
				
				// Todo: On redirige vers la dernière page
				// Todo: ajouter un message
				if (auth()->check()) return redirect(route('index'));
				
			// Todo: Sinon on affiche une erreur 404 (ou autre ...)
			abort(404);
			
			
			// voir les informations de l'utilisateur
			dd($email);
		}
		
		abort(404);
	}
	
	// Todo: create / Formulaire de création de compte
	public function create()
	{
		// Todo: fonction
	}
	
	// Todo: update / Formulaire de modification du compte
	public function update()
	{
		// Todo: fonction
	}
	
	// Todo: edit / Modification du compte
	public function edit()
	{
		// Todo: fonction
	}
	
	// Todo: store / Enregistre le nouveau compte
	public function store()
	{
		// Todo: fonction
	}
	
	// Todo: 
	
	
	
	
	
}
