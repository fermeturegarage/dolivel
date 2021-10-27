<?php

namespace Fermeturegarage\Dolivel;

use Fermeturegarage\Dolivel\Traits\ApiTrait;
use Fermeturegarage\Dolivel\Traits\CartTrait;
use Fermeturegarage\Dolivel\Traits\CategoriesTrait;
use Fermeturegarage\Dolivel\Traits\DocumentsTrait;
use Fermeturegarage\Dolivel\Traits\InvoicesTrait;
use Fermeturegarage\Dolivel\Traits\OrdersTrait;
use Fermeturegarage\Dolivel\Traits\ProductsTrait;
use Fermeturegarage\Dolivel\Traits\ProposalsTrait;
use Fermeturegarage\Dolivel\Traits\ShipmentsTrait;
use Fermeturegarage\Dolivel\Traits\TestTrait;
use Fermeturegarage\Dolivel\Traits\ThirdpartiesTrait;

class Api
{
	use ApiTrait, CartTrait, CategoriesTrait, DocumentsTrait, InvoicesTrait, OrdersTrait, ProductsTrait, ProposalsTrait, ShipmentsTrait, ThirdpartiesTrait;

	use TestTrait;
}
