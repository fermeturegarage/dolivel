<?php

namespace Fermeturegarage\Dolivel\Traits;

// On utilise Guzzle + Psr7 et ClientException pour gérer les exceptions
use GuzzleHttp\Client, GuzzleHttp\Psr7, GuzzleHttp\Exception\ClientException;
use GuzzleHttp\Exception\ServerException;

trait ApiTrait
{

	// Variables d'API Dolibarr
	private $_apiUrl;
	private $_apiKey;

	public function __construct()
	{
		// On charge les constantes qui se trouvent dans .env
		$this->_apiUrl = env('DOLIBARR_API_URL');
		$this->_apiKey = env('DOLIBARR_API_KEY');
	}

	/**
	* Requête GET sur l'API REST Dolibarr
	*
	* @param	string		$type
	* @param	string		$request
	*/
	public function requestDolibarr($type, $request, $data = false)
	{
		// On vérifie si le serveur API répond
		if(!@get_headers($this->_apiUrl))
		{
			return [
				'error' => [
					'request' => $this->_apiUrl.$request,
					'response' => 'The server is not responding'
				]
			];
		}

		try
		{
			// On initialise l'objet client de requêtes
			$client = new Client([
				'base_uri' => $this->_apiUrl
			]);

			if ($type == 'GET')
			{
				// On envoi la requête à l'API
				$response = $client->get($request, [
					'headers' => [
						'Accept' => 'application/json',
						'DOLAPIKEY' => $this->_apiKey
					]
				]);

				// On retourne la réponse en array
				return json_decode($response->getBody(), true); // true: tableau, false: objet
			}

			elseif ($type == 'PUT')
			{
				// Todo
			}

			elseif ($type == 'POST')
			{
				// Todo
				$response = $client->post($request, [
					'headers' => [
						'Accept' => 'application/json',
						'DOLAPIKEY' => $this->_apiKey
					],
					'body' => $data
				]);
			}

			elseif ($type == 'DELETE')
			{
				// Todo
			}

			else
			{
				// Si le type de requête n'est pas reconnu
				return [
					'error' => [
						'request' => $this->_apiUrl.$request,
						'response' => 'Unknown request type'
					]
				];
			}

		}
		// En cas de problème on récupère l'erreur
		catch (ClientException $e)
		{
			return [
				'error' => [
					'request' => Psr7\Message::toString($e->getRequest()),
					'response' => Psr7\Message::toString($e->getResponse())
				]
			];
		}
	}

	/**
	* Requête PUT sur l'API REST Dolibarr
	*/
	public function getDolibarr($request)
	{
		return $this->requestDolibarr('GET', $request);
	}

	/**
	* Requête PUT sur l'API REST Dolibarr
	*/
	public function putDolibarr($request, $data)
	{
		return $this->requestDolibarr('PUT', $request, $data);
	}

	/**
	* Requête POST sur l'API REST Dolibarr
	*/
	public function postDolibarr($request, $data)
	{
		return $this->requestDolibarr('POST', $request, $data);
	}

	/**
	* Requête DELETE sur l'API REST Dolibarr
	*/
	public function deleteDolibarr($request)
	{
		return false; // Todo
	}

	/**
	* Retourne une collection après avoir supprimé les éléments vides (fonction récursive)
	*/
	public function collectDolibarr($data)
	{
		$data = array_filter(
			$data,
			function($v, $k) {
				if (in_array($v, array("", null))) return false; // On supprime les "" et les null
				else return true;
			},
			ARRAY_FILTER_USE_BOTH
		);

		foreach ($data as $key => $value)
		{
			if (is_array($value))
			{
				$data[$key] = $this->collectDolibarr($value);
			}
		}

		return collect($data);
	}
}
