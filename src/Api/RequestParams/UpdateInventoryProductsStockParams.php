<?php

namespace Religisaci\Baselinker\Api\RequestParams;

use Religisaci\Baselinker\Exception\InvalidParameterException;

class UpdateInventoryProductsStockParams
{
	private int $inventory_id;
	private array $products = [];

	public function __construct(int $inventoryId)
	{
		$this->inventory_id = $inventoryId;
	}

	public function addProductStock(int $inventoryProductId, string $inventoryWarehouseId,int $count): void
	{
		$this->products[$inventoryProductId][$inventoryWarehouseId] = $count;
	}


	public function getParams(): array
	{
		if(!$this->inventory_id || $this->inventory_id <= 0)
		{
			throw new InvalidParameterException("Parameter inventory_id is not valid. Value must by greater then 0.");
		}
		return [
			'inventory_id' => $this->inventory_id,
			'products' => $this->products,
		];
	}
}