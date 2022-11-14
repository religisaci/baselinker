<?php

namespace Religisaci\Baselinker\Api;

use Religisaci\Baselinker\Exception\ResponseException;

class Inventory
{
	private Client $client;

	public function __construct(Client $client)
	{
		$this->client = $client;
	}

	/**
	 * @param array $params
	 * @return array
	 * @throws ResponseException
	 */
	public function getInventories(array $params = []): array
	{
		$inventories = [];
		$responseJSON = $this->client->post('getInventories', $params)->getBody()->getContents();
		$response = json_decode($responseJSON);
		if(!$response || !isset($response->status) || $response->status != 'SUCCESS')
		{
			throw new ResponseException("Bad response. Response body:\n" . var_export($response, TRUE));
		}

		foreach($response->inventories as $inventoryResponse)
		{
			$inventory = new \Religisaci\Baselinker\Model\Inventory();
			$inventory->inventory_id = (int)$inventoryResponse->inventory_id;
			$inventory->name = (string)$inventoryResponse->name;
			$inventory->description = (string)$inventoryResponse->description;
			$inventory->languages = (array)$inventoryResponse->languages;
			$inventory->default_language = (string)$inventoryResponse->default_language;
			$inventory->price_groups = (array)$inventoryResponse->price_groups;
			$inventory->default_price_group = (string)$inventoryResponse->default_price_group;
			$inventory->warehouses = (array)$inventoryResponse->warehouses;
			$inventory->default_warehouse = (string)$inventoryResponse->default_warehouse;
			$inventory->reservations = (bool)$inventoryResponse->reservations;
			$inventory->is_default = (bool)$inventoryResponse->is_default;
			$inventories[] = $inventory;
		}

		return $inventories;
	}

	public function addInventory(\Religisaci\Baselinker\Model\Inventory $inventory): \Religisaci\Baselinker\Model\Inventory
	{
		$responseJSON = (string)$this->client->post('addInventory', $inventory->getData())->getBody();
		$response = json_decode($responseJSON);
		if(!$response || !isset($response->status) || $response->status != 'SUCCESS')
		{
			throw new ResponseException("Bad response. Response body:\n" . var_export($response, TRUE));
		}

		$inventory->inventory_id = (int)$response->inventory_id;

		return $inventory;
	}

	public function deleteInventory(int $inventoryId): bool
	{
		$responseJSON = (string)$this->client->post('deleteInventory', ['inventory_id' => $inventoryId])->getBody();
		$response = json_decode($responseJSON);
		if(!$response || !isset($response->status) || $response->status != 'SUCCESS')
		{
			throw new ResponseException("Bad response. Response body:\n" . var_export($response, TRUE));
		}

		return TRUE;
	}
}