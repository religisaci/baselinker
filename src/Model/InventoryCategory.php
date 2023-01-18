<?php

namespace Religisaci\Baselinker\Model;

class InventoryCategory
{
	public int $inventory_id;
	public ?int $category_id;
	public ?string $name;
	public ?int $parent_id;

	public  function getData(): array
	{
		$data = [
			'inventory_id' => $this->inventory_id,
		];
		if(isset($this->category_id))
		{
			$data['category_id'] = $this->category_id;
		}
		if(isset($this->name))
		{
			$data['name'] = $this->name;
		}
		if(isset($this->parent_id))
		{
			$data['parent_id'] = $this->parent_id;
		}
		return $data;
	}
}