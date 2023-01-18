<?php

namespace Religisaci\Baselinker;

use Religisaci\Baselinker\Api\Client;
use Religisaci\Baselinker\Api\Inventory;
use Religisaci\Baselinker\Api\InventoryCategory;
use Religisaci\Baselinker\Api\InventoryManufacturer;
use Religisaci\Baselinker\Api\InventoryPriceGroup;
use Religisaci\Baselinker\Api\InventoryProduct;
use Religisaci\Baselinker\Api\InventoryWarehouse;
use Religisaci\Baselinker\Api\Order;
use Religisaci\Baselinker\Api\RepositoryFactory;

class Baselinker
{
	private Client $client;
	private Config $config;
	private RepositoryFactory $repositoryFactory;
	private ?InventoryManufacturer $inventoryManufacturer;

	public function __construct(array $config)
	{
		$this->config = new Config($config);
		$this->client = new Client($this->config->getConfigValue('token'));
		$this->repositoryFactory = new RepositoryFactory($this->client);
	}


	public function Inventory():Inventory
	{
		return $this->repositoryFactory->getInventory();
	}

	public function InventoryManufacturer():InventoryManufacturer
	{
		return $this->repositoryFactory->getInventoryManufacturer();
	}

	public function InventoryCategory():InventoryCategory
	{
		return $this->repositoryFactory->getInventoryCategory();
	}

	public function InventoryProduct():InventoryProduct
	{
		return $this->repositoryFactory->getInventoryProduct();
	}

	public function InventoryPriceGroup():InventoryPriceGroup
	{
		return $this->repositoryFactory->getInventoryPriceGroup();
	}

	public function InventoryWarehouse():InventoryWarehouse
	{
		return $this->repositoryFactory->getInventoryWarehouse();
	}

	public function Order():Order
	{
		return $this->repositoryFactory->getOrder();
	}
}
