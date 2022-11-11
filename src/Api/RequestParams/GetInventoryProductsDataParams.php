<?php

namespace Baselinker\Api\RequestParams;

use Baselinker\Api\Exception\InvalidParameterException;

class GetInventoryProductsDataParams
{
	public int $inventory_id;
	public array $products;

	public function getParams(): array
	{
		if(!$this->inventory_id || $this->inventory_id <= 0)
		{
			throw new InvalidParameterException("Parameter inventory_id is not valid. Value must by greater then 0.");
		}
		if(!$this->products)
		{
			throw new InvalidParameterException("Parameter products cant be empty");
		}
		if(!array_filter($this->products, 'is_int'))
		{
			throw new InvalidParameterException("Parameter products must contain only values with type int.");
		}
		return [
			'inventory_id' => $this->inventory_id,
			'products' => $this->products,
		];
	}
}