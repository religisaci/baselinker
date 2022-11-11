<?php

namespace Religisaci\Baselinker\Model;

class InventoryManufacturer
{
	public 	?int $manufacturer_id;
	public string $name;

	public  function getData(): array
	{
		$data = [
			'name' => $this->name,
		];
		if(isset($this->manufacturer_id))
		{
			$data['manufacturer_id'] = $this->manufacturer_id;
		}
		return $data;
	}
}