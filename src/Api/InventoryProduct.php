<?php

namespace Religisaci\Baselinker\Api;

use Religisaci\Baselinker\Api\RequestParams\UpdateInventoryProductsPricesParams;
use Religisaci\Baselinker\Api\RequestParams\UpdateInventoryProductsStockParams;
use Religisaci\Baselinker\Exception\ResponseException;
use Religisaci\Baselinker\Api\RequestParams\GetInventoryAvailableTextFieldKeys;
use Religisaci\Baselinker\Api\RequestParams\GetInventoryProductsDataParams;
use Religisaci\Baselinker\Api\RequestParams\GetInventoryProductsList;
use Religisaci\Baselinker\Api\RequestParams\GetInventoryProductsListParams;

class InventoryProduct
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
	 * @param GetInventoryProductsDataParams|null $params
	 * @return array
	 * @throws Exception\InvalidParameterException
	 * @throws ResponseException
	 */
	public function getInventoryProductsData(?GetInventoryProductsDataParams $params = NULL): array
	{
		$inventoryProducts = [];
		$responseJSON = (string)$this->client->post('getInventoryProductsData', $params ? $params->getParams() : [])->getBody();
		$response = json_decode($responseJSON);
		if(!$response || !isset($response->status) || $response->status != 'SUCCESS')
		{
			throw new ResponseException("Bad response. Response body:\n" . var_export($response, TRUE));
		}

		foreach($response->products as $productId => $inventoryProductResponse)
		{
			$inventoryProduct = new \Religisaci\Baselinker\Model\InventoryProduct();
			$inventoryProduct->product_id = (int)$productId;
			$inventoryProduct->inventory_id = $params->inventory_id;
			$inventoryProduct->is_bundle = (bool)$inventoryProductResponse->is_bundle;
			$inventoryProduct->ean = (string)$inventoryProductResponse->ean;
			$inventoryProduct->sku = (string)$inventoryProductResponse->sku;
			$inventoryProduct->tax_rate = (float)$inventoryProductResponse->tax_rate;
			$inventoryProduct->weight = (float)$inventoryProductResponse->weight;
			$inventoryProduct->height = (float)$inventoryProductResponse->height;
			$inventoryProduct->width = (float)$inventoryProductResponse->width;
			$inventoryProduct->length = (float)$inventoryProductResponse->length;
			$inventoryProduct->star = (float)$inventoryProductResponse->star;
			$inventoryProduct->category_id = (int)$inventoryProductResponse->category_id;
			$inventoryProduct->manufacturer_id = (int)$inventoryProductResponse->manufacturer_id;
			$inventoryProduct->prices = (array)$inventoryProductResponse->prices;
			$inventoryProduct->stock = (array)$inventoryProductResponse->stock;
			$inventoryProduct->locations = (array)$inventoryProductResponse->locations;
			$inventoryProduct->text_fields = (array)$inventoryProductResponse->text_fields;
			$inventoryProduct->average_cost = (float)$inventoryProductResponse->average_cost;
			$inventoryProduct->average_landed_cost = (float)$inventoryProductResponse->average_landed_cost;
			$inventoryProduct->images = (object)$inventoryProductResponse->images;
			$inventoryProduct->links = (array)$inventoryProductResponse->links;
			$inventoryProduct->variants = (array)$inventoryProductResponse->variants;
			$inventoryProducts[] = $inventoryProduct;
		}

		return $inventoryProducts;
	}

	/**
	 * @param GetInventoryProductsListParams|null $params
	 * @return array
	 * @throws Exception\InvalidParameterException
	 * @throws ResponseException
	 */
	public function getInventoryProductsList(?GetInventoryProductsListParams $params = NULL): array
	{
		$inventoryProducts = [];
		$responseJSON = (string)$this->client->post('getInventoryProductsList', $params ? $params->getParams() : [])->getBody();
		$response = json_decode($responseJSON);
		if(!$response || !isset($response->status) || $response->status != 'SUCCESS')
		{
			$exception = new ResponseException("Bad response. Response body:\n" . var_export($response, TRUE));
			$exception->response = $responseJSON;
			throw $exception;
		}

		foreach($response->products as $productId => $inventoryProductResponse)
		{
			$inventoryProduct = new \Religisaci\Baselinker\Model\InventoryProduct();
			$inventoryProduct->product_id = (int)$inventoryProductResponse->id;
			$inventoryProduct->inventory_id = $params->inventory_id;
			$inventoryProduct->ean = (string)$inventoryProductResponse->ean;
			$inventoryProduct->sku = (string)$inventoryProductResponse->sku;
			$inventoryProduct->name = (string)$inventoryProductResponse->name;
			$inventoryProduct->prices = (array)$inventoryProductResponse->prices;
			$inventoryProduct->stock = (array)$inventoryProductResponse->stock;
			$inventoryProducts[] = $inventoryProduct;
		}

		return $inventoryProducts;
	}

	/**
	 * @param \Religisaci\Baselinker\Model\InventoryProduct $inventoryProduct
	 * @return \Religisaci\Baselinker\Model\InventoryProduct
	 * @throws ResponseException
	 */
	public function addInventoryProduct(\Religisaci\Baselinker\Model\InventoryProduct $inventoryProduct): \Religisaci\Baselinker\Model\InventoryProduct
	{
		$responseJSON = (string)$this->client->post('addInventoryProduct', $inventoryProduct->getData())->getBody();
		$response = json_decode($responseJSON);

		if(!$response || !isset($response->status) || $response->status != 'SUCCESS')
		{
			$exception = new ResponseException("Bad response. Response body:\n" . var_export($response, TRUE));
			$exception->response = $responseJSON;
			throw $exception;
		}

		$inventoryProduct->product_id = (int)$response->product_id;

		return $inventoryProduct;
	}

	/**
	 * @param int $inventoryProductId
	 * @return bool
	 * @throws ResponseException
	 */
	public function deleteInventoryProduct(int $inventoryProductId): bool
	{
		$responseJSON = (string)$this->client->post('deleteInventoryProduct', ['product_id' => $inventoryProductId])->getBody();
		$response = json_decode($responseJSON);
		if(!$response || !isset($response->status) || $response->status != 'SUCCESS')
		{
			$exception = new ResponseException("Bad response. Response body:\n" . var_export($response, TRUE));
			$exception->response = $responseJSON;
			throw $exception;
		}

		return TRUE;
	}

	/**
	 * @param GetInventoryAvailableTextFieldKeys $params
	 * @return \stdClass
	 * @throws Exception\InvalidParameterException
	 * @throws ResponseException
	 */
	public function getInventoryAvailableTextFieldKeys(GetInventoryAvailableTextFieldKeys $params): \stdClass
	{
		$responseJSON = (string)$this->client->post('getInventoryAvailableTextFieldKeys', $params ? $params->getParams() : [])->getBody();
		$response = json_decode($responseJSON);
		if(!$response || !isset($response->status) || $response->status != 'SUCCESS')
		{
			$exception = new ResponseException("Bad response. Response body:\n" . var_export($response, TRUE));
			$exception->response = $responseJSON;
			throw $exception;
		}

		return $response->text_field_keys;
	}


	/**
	 * @param UpdateInventoryProductsStockParams $params
	 * @return int
	 * @throws \Religisaci\Baselinker\Exception\InvalidParameterException
	 */
	public function updateInventoryProductsStock(UpdateInventoryProductsStockParams $params): int
	{
		$responseJSON = (string)$this->client->post('updateInventoryProductsStock', $params->getParams())->getBody();
		$response = json_decode($responseJSON);
		if(!$response || !isset($response->status) || $response->status != 'SUCCESS')
		{
			$exception = new ResponseException("Bad response. Response body:\n" . var_export($response, TRUE));
			$exception->response = $responseJSON;
			throw $exception;
		}

		return (int)$response->counter;
	}


	public function updateInventoryProductsPrices(UpdateInventoryProductsPricesParams $params): int
	{
		$responseJSON = (string)$this->client->post('updateInventoryProductsPrices', $params->getParams())->getBody();
		$response = json_decode($responseJSON);
		if(!$response || !isset($response->status) || $response->status != 'SUCCESS')
		{
			$exception = new ResponseException("Bad response. Response body:\n" . var_export($response, TRUE));
			$exception->response = $responseJSON;
			throw $exception;
		}

		return (int)$response->counter;
	}
}