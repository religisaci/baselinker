<?php

namespace Religisaci\Baselinker\Api\RequestParams;

use Religisaci\Baselinker\Exception\InvalidParameterException;

class GetCourierFields
{
	public string $courier_code;

	public function getParams(): array
	{
		if(!$this->courier_code)
		{
			throw new InvalidParameterException("Parameter courier_code must be setted.");
		}
		return [
			'courier_code' => $this->courier_code,
		];
	}
}