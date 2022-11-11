<?php

namespace Religisaci\Baselinker;

use Religisaci\Baselinker\Api\Client;
use Religisaci\Baselinker\Api\Inventory;
use Religisaci\Baselinker\Api\InventoryManufacturer;
use Religisaci\Baselinker\Api\InventoryProduct;
use Religisaci\Baselinker\Api\RepositoryFactory;

class Baselinker
{
	private Client $client;
	private RepositoryFactory $repositoryFactory;
	private ?InventoryManufacturer $inventoryManufacturer;

	public function __construct(string $token)
	{
		$this->client = new Client($token);
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

	public function InventoryProduct():InventoryProduct
	{
		return $this->repositoryFactory->getInventoryProduct();
	}

	public function getProductsList()
	{
		dump(json_decode($this->client->post('getInventoryProductsList', [
			'inventory_id' => 33144,

		])->getBody()->getContents()));
	}

	public function getProducts()
	{
		dump(json_decode($this->client->post('getInventoryProductsData', [
			'inventory_id' => 33144,
			'products' => [151812322],
		])->getBody()->getContents()));
	}

	public function getInventories()
	{
		dump(json_decode($this->client->post('getInventories', [])->getBody()->getContents()));
	}
}