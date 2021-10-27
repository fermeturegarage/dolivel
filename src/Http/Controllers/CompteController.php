<?php

namespace Fermeturegarage\Dolivel\Http\Controllers;

use Illuminate\Http\Request;

use Laravel\Socialite\Facades\Socialite;
use Illuminate\Foundation\Auth\User;
use Illuminate\Support\Facades\Auth;
use Fermeturegarage\Dolivel\Facades\Dolivel;

class CompteController extends Controller
{
    /**
     * Affiche les informations d'un client
     *
     * @param \Illuminate\Http\Request $request
     * @return \Fermeturegarage\Dolivel\Api postThirdparties()
     */
	public function client(Request $request)
	{
	//	$input = $request->all();

		// TODO: A MODIFIER LA C'EST POUR TESTER !!!!!!!!
        return Dolivel::postThirdparties();
	}

    /**
     * TODO: index / Affiche les informations de compte
     *
     * @return
     */
	public function index()
	{
		// TODO: fonction
	}

    /**
     * TODO: connexion / Connexion au compte client
     *
     * @return
     */
	public function connexion()
	{
		// TODO: fonction
	}





	// Providers autorisés
    // TODO : METTRE EN FICHIER DE CONFIG
	protected $providers = ['facebook', 'google', 'github', 'linkedin'];

	// TODO: socialiteRegister / La page où on présente les liens de redirection vers les providers
	// A SUPPRIMER
	public function socialiteRegister()
	{
		// TODO: fonction
		return view("connexion.login_register");
	}





    /**
     * TODO: socialiteRedirect / La redirection vers le provider
     *
     * @return
     */
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

    /**
     * TODO: socialiteCallback / Le callback du provider
     *
     * @return
     */
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

			// TODO: Vérifie si le compte existe
				// TODO: S'il existe s'authentifier et éventuellement mettre à jour les informations du client
				// TODO: S'il n'existe pas on enregistre le nouveau client
				$user = User::create([
					'name' => $name,
					'email' => $email,
					'password' => bcrypt("emilie") // On attribue un mot de passe
				]);

				// TODO: On connecte le client
				Auth::login($user); // auth()->login($user)

				// TODO: On redirige vers la dernière page
				// TODO: ajouter un message
				if (Auth::check()) return redirect(route('index')); // auth()->check())

			// TODO: Sinon on affiche une erreur 404 (ou autre ...)
			abort(404);


			// voir les informations de l'utilisateur
			dd($email);
		}

		abort(404);
	}

    /**
     * TODO: create / Formulaire de création de compte
     *
     * @return
     */
	public function create()
	{
		// TODO: fonction
	}

    /**
     * TODO: update / Formulaire de modification du compte
     *
     * @return
     */
	public function update()
	{
		// TODO: fonction
	}

    /**
     * TODO: edit / Modification du compte
     *
     * @return
     */
	public function edit()
	{
		// TODO: fonction
	}

    /**
     * TODO: store / Enregistre le nouveau compte
     *
     * @return
     */
	public function store()
	{
		// TODO: fonction
	}
}
