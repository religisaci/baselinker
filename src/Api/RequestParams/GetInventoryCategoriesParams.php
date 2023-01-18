<?php

namespace Religisaci\Baselinker\Api\RequestParams;

use Religisaci\Baselinker\Exception\InvalidParameterException;

class GetInventoryCategoriesParams
{
	public int $inventory_id;

	public function getParams(): array
	{
		if(!$this->inventory_id || $this->inventory_id <= 0)
		{
			throw new InvalidParameterException("Parameter inventory_id is not valid. Value must by greater then 0.");
		}
		$params = [
			'inventory_id' => $this->inventory_id,
		];


		return $params;
	}
}