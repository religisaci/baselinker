<?php

namespace Religisaci\Baselinker\Api;

class InventoryWarehouse
{
	private Client $client;

	/**
	 * @param Client $client
	 */
	public function __construct(Client $client)
	{
		$this->client = $client;
	}

	/**
	 * @return array
	 */
	public function getInventoryWarehouses(): array
	{
		$inventoryWarehouses = [];
		$responseJSON = (string)$this->client->post('getInventoryWarehouses')->getBody();
		$response = json_decode($responseJSON);
		if(!$response || !isset($response->status) || $response->status != 'SUCCESS')
		{
			$exception = new ResponseException("Bad response. Response body:\n" . var_export($response, TRUE));
			$exception->response = $responseJSON;
			throw $exception;
		}
		foreach($response->warehouses as $inventoryWarehouseResponse)
		{
			$inventoryWarehouse = new \Religisaci\Baselinker\Model\InventoryWarehouse();
			$inventoryWarehouse->warehouse_type = (string)$inventoryWarehouseResponse->warehouse_type;
			$inventoryWarehouse->warehouse_id = (int)$inventoryWarehouseResponse->warehouse_id;
			$inventoryWarehouse->name = (string)$inventoryWarehouseResponse->name;
			$inventoryWarehouse->description = (string)$inventoryWarehouseResponse->description;
			$inventoryWarehouse->stock_edition = (bool)$inventoryWarehouseResponse->stock_edition;
			$inventoryWarehouse->is_default = (bool)$inventoryWarehouseResponse->is_default;
			$inventoryWarehouses[] = $inventoryWarehouse;
		}

		return $inventoryWarehouses;
	}

	public function addInventoryWarehouse(\Religisaci\Baselinker\Model\InventoryWarehouse $inventoryWarehouse): \Religisaci\Baselinker\Model\InventoryWarehouse
	{
		$responseJSON = (string)$this->client->post('addInventoryWarehouse', $inventoryWarehouse->getData())->getBody();
		$response = json_decode($responseJSON);
		if(!$response || !isset($response->status) || $response->status != 'SUCCESS')
		{
			$exception = new ResponseException("Bad response. Response body:\n" . var_export($response, TRUE));
			$exception->response = $responseJSON;
			throw $exception;
		}

		$inventoryWarehouse->warehouse_id = (int)$response->warehouse_id;

		return $inventoryWarehouse;
	}


	public function deleteInventoryWarehouse(int $inventoryWarehouseId): bool
	{
		$responseJSON = (string)$this->client->post('deleteInventoryWarehouse', ['warehouse_id' => $inventoryWarehouseId])->getBody();
		$response = json_decode($responseJSON);
		if(!$response || !isset($response->status) || $response->status != 'SUCCESS')
		{
			$exception = new ResponseException("Bad response. Response body:\n" . var_export($response, TRUE));
			$exception->response = $responseJSON;
			throw $exception;
		}

		return TRUE;
	}
}