<?php

namespace Religisaci\Baselinker\Api;

use Religisaci\Baselinker\Api\Exception\ResponseException;

class InventoryManufacturer
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
	public function getInventoryManufacturers(array $params = []): array
	{
		$inventoryManufacturers = [];
		$responseJSON = (string)$this->client->post('getInventoryManufacturers', $params)->getBody();
		$response = json_decode($responseJSON);
		if(!$response || !isset($response->status) || $response->status != 'SUCCESS')
		{
			throw new ResponseException("Bad response. Response body:\n" . var_export($response, TRUE));
		}
		foreach($response->manufacturers as $inventoryManufacturerResponse)
		{
			$inventoryManufacturer = new \Religisaci\Baselinker\Model\InventoryManufacturer();
			$inventoryManufacturer->manufacturer_id = (int)$inventoryManufacturerResponse->manufacturer_id;
			$inventoryManufacturer->name = (string)$inventoryManufacturerResponse->name;
			$inventoryManufacturers[] = $inventoryManufacturer;
		}


		return $inventoryManufacturers;
	}

	public function addInventoryManufacturer(\Religisaci\Baselinker\Model\InventoryManufacturer $inventoryManufacturer): \Religisaci\Baselinker\Model\InventoryManufacturer
	{
		$responseJSON = (string)$this->client->post('addInventoryManufacturer', $inventoryManufacturer->getData())->getBody();
		$response = json_decode($responseJSON);
		if(!$response || !isset($response->status) || $response->status != 'SUCCESS')
		{
			throw new ResponseException("Bad response. Response body:\n" . var_export($response, TRUE));
		}

		$inventoryManufacturer->manufacturer_id = (int)$response->manufacturer_id;

		return $inventoryManufacturer;
	}

	public function deleteInventoryManufacturer(int $inventoryManufacturerId): bool
	{
		$responseJSON = (string)$this->client->post('deleteInventoryManufacturer', ['manufacturer_id' => $inventoryManufacturerId])->getBody();
		$response = json_decode($responseJSON);
		if(!$response || !isset($response->status) || $response->status != 'SUCCESS')
		{
			throw new ResponseException("Bad response. Response body:\n" . var_export($response, TRUE));
		}

		return TRUE;
	}
}