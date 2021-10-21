<?php

namespace Dolivel;

use Dolivel\Traits\ApiTrait;
use Dolivel\Traits\CartTrait;
use Dolivel\Traits\CategoriesTrait;
use Dolivel\Traits\DocumentsTrait;
use Dolivel\Traits\InvoicesTrait;
use Dolivel\Traits\OrdersTrait;
use Dolivel\Traits\ProductsTrait;
use Dolivel\Traits\ProposalsTrait;
use Dolivel\Traits\ShipmentsTrait;
use Dolivel\Traits\TestTrait;
use Dolivel\Traits\ThirdpartiesTrait;

class Api
{
	use ApiTrait, CartTrait, CategoriesTrait, DocumentsTrait, InvoicesTrait, OrdersTrait, ProductsTrait, ProposalsTrait, ShipmentsTrait, ThirdpartiesTrait;

	use TestTrait;
}
