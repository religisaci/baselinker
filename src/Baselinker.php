<?php

namespace Baselinker;

use Baselinker\Api\Client;
use Baselinker\Api\Inventory;
use Baselinker\Api\InventoryManufacturer;
use Baselinker\Api\InventoryProduct;
use Baselinker\Api\RepositoryFactory;
use Mpdf\Tag\I;

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