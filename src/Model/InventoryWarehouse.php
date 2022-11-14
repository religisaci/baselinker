<?php

namespace Religisaci\Baselinker\Model;

class InventoryWarehouse
{
	public ?string $warehouse_type;
	public ?int $warehouse_id;
	public string $name;
	public ?string $description;
	public ?bool $stock_edition;
	public ?bool $is_default;

	public function getData(): array
	{
		$data = [
			'name' => $this->name,
		];
		if(isset($this->warehouse_id))
		{
			$data['warehouse_id'] = $this->warehouse_id;
		}
		if(isset($this->description))
		{
			$data['description'] = $this->description;
		}
		if(isset($this->stock_edition))
		{
			$data['stock_edition'] = $this->stock_edition;
		}
		return $data;
	}
}