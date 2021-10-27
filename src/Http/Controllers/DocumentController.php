<?php

namespace Fermeturegarage\Dolivel\Http\Controllers;

use Fermeturegarage\Dolivel\Facades\Dolivel;

class DocumentController extends Controller
{
    /**
     * Télécharge un document Dolibarr
     *
     * @param string ['modulepart', 'file'] > json > Base64
     * @return \Fermeturegarage\Dolivel\Api downloadDocumentBase64()
     */
    public function download($jsonBase64)
    {
        return Dolivel::downloadDocumentBase64($jsonBase64);
		// return $this->dolivel->downloadDocumentBase64($jsonBase64);
    }
}
