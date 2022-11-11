<?php

namespace Religisaci\Baselinker\Api\RequestParams;

use Religisaci\Baselinker\Api\Exception\InvalidParameterException;

class GetInventoryAvailableTextFieldKeys
{
	public int $inventory_id;

	public function getParams(): array
	{
		if(!$this->inventory_id || $this->inventory_id <= 0)
		{
			throw new InvalidParameterException("Parameter inventory_id is not valid. Value must by greater then 0.");
		}
		return [
			'inventory_id' => $this->inventory_id,
		];
	}
}