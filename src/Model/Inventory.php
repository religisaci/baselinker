<?php

namespace Religisaci\Baselinker\Model;

class Inventory
{
	public ?int $inventory_id;
	public string $name;
	public ?string $description;
	public ?array $languages;
	public ?string $default_language;
	public ?array $price_groups;
	public ?int $default_price_group;
	public ?array $warehouses;
	public ?string $default_warehouse;
	public ?bool $reservations;
	public ?bool $is_default;

	public  function getData(): array
	{
		$data = [
			'name' => $this->name,
		];
		if(isset($this->description))
		{
			$data['description'] = $this->description;
		}
		if(isset($this->languages))
		{
			$data['languages'] = $this->languages;
		}
		if(isset($this->default_language))
		{
			$data['default_language'] = $this->default_language;
		}
		if(isset($this->price_groups))
		{
			$data['price_groups'] = $this->price_groups;
		}
		if(isset($this->default_price_group))
		{
			$data['default_price_group'] = $this->default_price_group;
		}
		if(isset($this->warehouses))
		{
			$data['warehouses'] = $this->warehouses;
		}
		if(isset($this->default_warehouse))
		{
			$data['default_warehouse'] = $this->default_warehouse;
		}
		if(isset($this->reservations))
		{
			$data['reservations'] = $this->reservations;
		}
		return $data;
	}
}