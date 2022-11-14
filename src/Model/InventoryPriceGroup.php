<?php

namespace Religisaci\Baselinker\Model;

class InventoryPriceGroup
{
	public ?int $price_group_id;
	public string $name;
	public ?string $description;
	public ?string $currency;
	public ?bool $is_default;
}