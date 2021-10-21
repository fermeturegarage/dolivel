<?php

namespace App\Http\Controllers;

// On va chercher la méthode dolivelRepository
use App\Repositories\dolivelRepository;

class DocumentController extends DolivelController
{
    /* Télécharge un document ['modulepart', 'file'] > json > Base64 */
    public function download($jsonBase64)
    {
		return $this->dolivel->downloadDocumentBase64($jsonBase64);
    }
}
