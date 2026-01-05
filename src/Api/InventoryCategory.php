<?php

namespace Religisaci\Baselinker\Api;

use Religisaci\Baselinker\Api\RequestParams\GetInventoryCategoriesParams;
use Religisaci\Baselinker\Exception\ResponseException;

class InventoryCategory
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
	 * @param array $params
	 * @return array
	 * @throws ResponseException
	 */
	public function getInventoryCategories(?GetInventoryCategoriesParams $params = NULL): array
	{
		$inventoryCategories = [];
		$responseJSON = (string)$this->client->post('getInventoryCategories', $params ? $params->getParams() : []);
		$response = json_decode($responseJSON);
		if(!$response || !isset($response->status) || $response->status != 'SUCCESS')
		{
			$exception = new ResponseException("Bad response. Response body:\n" . var_export($response, TRUE));
			$exception->response = $responseJSON;
			throw $exception;
		}
		foreach($response->categories as $inventoryCategoryResponse)
		{
			$inventoryCategory = new \Religisaci\Baselinker\Model\InventoryCategory();
			$inventoryCategory->category_id = (int)$inventoryCategoryResponse->category_id;
			$inventoryCategory->name = (string)$inventoryCategoryResponse->name;
			$inventoryCategory->parent_id = (int)$inventoryCategoryResponse->parent_id;
			$inventoryCategories[] = $inventoryCategory;
		}


		return $inventoryCategories;
	}

	/**
	 * @param \Religisaci\Baselinker\Model\InventoryCategory $inventoryCategory
	 * @return \Religisaci\Baselinker\Model\InventoryCategory
	 * @throws ResponseException
	 */
	public function addInventoryCategory(\Religisaci\Baselinker\Model\InventoryCategory $inventoryCategory): \Religisaci\Baselinker\Model\InventoryCategory
	{
		$responseJSON = (string)$this->client->post('addInventoryCategory', $inventoryCategory->getData());
		$response = json_decode($responseJSON);
		if(!$response || !isset($response->status) || $response->status != 'SUCCESS')
		{
			$exception = new ResponseException("Bad response. Response body:\n" . var_export($response, TRUE));
			$exception->response = $responseJSON;
			throw $exception;
		}

		$inventoryCategory->category_id = (int)$response->category_id;

		return $inventoryCategory;
	}

	/**
	 * @param int $inventoryCategoryId
	 * @return bool
	 * @throws ResponseException
	 */
	public function deleteInventoryCategory(int $inventoryCategoryId): bool
	{
		$responseJSON = (string)$this->client->post('deleteInventoryCategory', ['category_id' => $inventoryCategoryId]);
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
