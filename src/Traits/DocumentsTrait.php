<?php

namespace Fermeturegarage\Dolivel\Traits;

trait DocumentsTrait
{

	/*	GET the list of documents of a dedicated element (from its ID)
	*	$id @long ID of element
	*	$modulepart @string Name of module or area concerned ('thirdparty', 'member', 'proposal', 'order', 'invoice', 'supplier_invoice', 'shipment', 'project', ...)
	*	"documents?modulepart=MODULEPART&id=ID&sortfield=date&sortorder=asc"
	*/
	public function getDocumentsById($id, $modulepart = 'produit')
	{
		$sortfield = 'date'; // Sort criteria ('','fullname','relativename','name','date','size')
		$sortorder = 'ASC'; // Sort order ('asc' or 'desc')

		$documents = $this->getDolibarr('documents?modulepart='.$modulepart.'&id='.$id); // On récupère les documents associés

		if (isset($documents['error'])) // S'il y a une erreur on retourne une collection vide
			return collect([]);

		$images = $pdf = $divers = array();
		$data = collect([]);

		foreach($documents as $document)
		{
			$document = [
				'level1name' => $document['level1name'],
				'name' => $document['name'],
				'url' => 'http://dolibarr.test/document.php?modulepart='.$modulepart.'&file='.urlencode($document['level1name'].'/'.$document['name']),
				'base64url' => base64_encode(json_encode(
					[
						'file' => urlencode($document['level1name'].'/'.$document['name']),
						'modulepart' => $modulepart,
					]
				)),
				'size' => $document['size'],
			];

			if (preg_match('/\.(jpg|jpeg|png|gif)/', $document['name']))
			{
				$images[] = $document;
			}
			elseif (stripos($document['name'], '.pdf'))
			{
				$pdf[] = $document;
			}
			else
			{
				$divers[] = $document;
			}
		}

		if (!empty($images)) $data->put('images', $images);
		if (!empty($pdf)) $data->put('pdf', $pdf);
		if (!empty($divers)) $data->put('divers', $divers);

		return $data;
	}

	/*	GET download a document
	*	$modulepart @string Name of module or area concerned by file download ('facture', ...)
	*	$file @string Relative path with filename, relative to modulepart (for example: IN201701-999/IN201701-999.pdf)
	*	"documents/download?modulepart=MODULEPART&original_file=FILE"
	*/
	public function downloadDocumentByFile($file, $modulepart = 'produit')
	{
		return $this->getDolibarr('documents/download?modulepart='.$modulepart.'&original_file='.$file);
	}

	/*	Download avec une entête ['modulepart', 'file'] encodé en json puis Base64
	*	$jsonBase64 @string
	*/
	public function downloadDocumentBase64($jsonBase64)
	{
		// $file is json_encode(['modulepart' => 'MODULEPART', 'file' => 'LEVELNAME/NAME']);
		// Test eyJtb2R1bGVwYXJ0IjoicHJvZHVpdCIsImZpbGUiOiJURVNUXC9URVNULTIwMThfMTBfMTAgLSBJTUdfMTM0MiBNSU5JLmpwZyJ9
		$file = json_decode(base64_decode($jsonBase64), true);

		if(!is_array($file)) return ['error' => ['response' => 'Fichier non reconnu']];

		$file = $this->downloadDocumentByFile($file['file'], $file['modulepart']); // filename / content-type 'image/jpeg' / filesize / content / encoding 'base64'

		$headers = array(
			"Content-type" => $file['content-type'],
			"Content-Disposition" => "attachment; filename=".$file['filename'],
			"Cache-Control" => "no-cache,no-store,must-revalidate,pre-check=0,post-check=0",
			"Expires" => "0"
		);

		$contents = base64_decode($file['content']);
		$filename = $file['filename'];

		$callback = function () use ($contents)
		{
			echo $contents;
		};

		return response()->streamDownload($callback, $filename, $headers);
	}
}
