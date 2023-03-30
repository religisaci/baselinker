<?php

namespace Religisaci\Baselinker\Api;

use Religisaci\Baselinker\Exception\ResponseException;

class InventoryPriceGroup
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
	 * @throws ResponseException
	 */
	public function getInventoryPriceGroups(): array
	{
		$inventoryPriceGroups = [];
		$responseJSON = (string)$this->client->post('getInventoryPriceGroups');
		$response = json_decode($responseJSON);
		if(!$response || !isset($response->status) || $response->status != 'SUCCESS')
		{
			$exception = new ResponseException("Bad response. Response body:\n" . var_export($response, TRUE));
			$exception->response = $responseJSON;
			throw $exception;
		}
		foreach($response->price_groups as $inventoryPriceGroupResponse)
		{
			$inventoryPriceGroup = new \Religisaci\Baselinker\Model\InventoryPriceGroup();
			$inventoryPriceGroup->price_group_id = (int)$inventoryPriceGroupResponse->price_group_id;
			$inventoryPriceGroup->name = (string)$inventoryPriceGroupResponse->name;
			$inventoryPriceGroup->description = (string)$inventoryPriceGroupResponse->description;
			$inventoryPriceGroup->currency = (string)$inventoryPriceGroupResponse->currency;
			$inventoryPriceGroup->is_default = (bool)$inventoryPriceGroupResponse->is_default;
			$inventoryPriceGroups[] = $inventoryPriceGroup;
		}


		return $inventoryPriceGroups;
	}
}