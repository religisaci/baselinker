<?php

namespace Religisaci\Baselinker\Api;

class RepositoryFactory
{
	private Inventory $inventory;
	private InventoryManufacturer $inventoryManufacturer;
	private InventoryCategory $inventoryCategory;
	private InventoryProduct $inventoryProduct;
	private InventoryPriceGroup $inventoryPriceGroup;
	private InventoryWarehouse $inventoryWarehouse;
	private Order $order;
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
	 * @return InventoryCategory
	 */
	public function getInventoryCategory():InventoryCategory
	{
		if(!isset($this->inventoryCategory))
		{
			$this->inventoryCategory = new InventoryCategory($this->client);
		}

		return $this->inventoryCategory;
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

	public function getOrder():Order
	{
		if(!isset($this->order))
		{
			$this->order = new Order($this->client);
		}

		return $this->order;
	}
}