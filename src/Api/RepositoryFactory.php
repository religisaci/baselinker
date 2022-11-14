<?php

namespace Religisaci\Baselinker\Api;

class RepositoryFactory
{
	private Inventory $inventory;
	private InventoryManufacturer $inventoryManufacturer;
	private InventoryProduct $inventoryProduct;
	private InventoryPriceGroup $inventoryPriceGroup;
	private InventoryWarehouse $inventoryWarehouse;
	private Client $client;

	/**
	 * @param Client $client
	 */
	public function __construct( Client $client)
	{
		$this->client = $client;
	}

	/**
	 * @return Inventory
	 */
	public function getInventory():Inventory
	{
		if(!isset($this->inventory))
		{
			$this->inventory = new Inventory($this->client);
		}

		return $this->inventory;
	}

	/**
	 * @return InventoryManufacturer
	 */
	public function getInventoryManufacturer():InventoryManufacturer
	{
		if(!isset($this->inventoryManufacturer))
		{
			$this->inventoryManufacturer = new InventoryManufacturer($this->client);
		}

		return $this->inventoryManufacturer;
	}

	/**
	 * @return InventoryProduct
	 */
	public function getInventoryProduct():InventoryProduct
	{
		if(!isset($this->inventoryProduct))
		{
			$this->inventoryProduct = new InventoryProduct($this->client);
		}

		return $this->inventoryProduct;
	}

	/**
	 * @return InventoryProduct
	 */
	public function getInventoryPriceGroup():InventoryPriceGroup
	{
		if(!isset($this->inventoryPriceGroup))
		{
			$this->inventoryPriceGroup = new InventoryPriceGroup($this->client);
		}

		return $this->inventoryPriceGroup;
	}

	/**
	 * @return InventoryWarehouse
	 */
	public function getInventoryWarehouse():InventoryWarehouse
	{
		if(!isset($this->inventoryWarehouse))
		{
			$this->inventoryWarehouse = new InventoryWarehouse($this->client);
		}

		return $this->inventoryWarehouse;
	}
}