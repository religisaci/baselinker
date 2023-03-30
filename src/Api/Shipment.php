<?php

namespace Religisaci\Baselinker\Api;

use Religisaci\Baselinker\Api\RequestParams\GetCourierFields;
use Religisaci\Baselinker\Exception\ResponseException;
use Religisaci\Baselinker\Model\PackageManual;

class Shipment
{
	private Client $client;

	/**
	 * @param Client $client
	 */
	public function __construct(Client $client)
	{
		$this->client = $client;
	}

	public function createPackageManual(PackageManual $packageManual): PackageManual
	{
		$responseJSON = (string)$this->client->post('createPackageManual', $packageManual->getData());
		$response = json_decode($responseJSON);
		if(!$response || !isset($response->status) || $response->status != 'SUCCESS')
		{
			$exception = new ResponseException("Bad response. Response body:\n" . var_export($response, TRUE));
			$exception->response = $responseJSON;
			throw $exception;
		}

		$packageManual->package_id = (int)$response->package_id;

		return $packageManual;
	}

	public function getCouriersList()
	{
		$couriers = [];
		$responseJSON = (string)$this->client->post('getCouriersList');
		$response = json_decode($responseJSON);
		if(!$response || !isset($response->status) || $response->status != 'SUCCESS')
		{
			$exception = new ResponseException("Bad response. Response body:\n" . var_export($response, TRUE));
			$exception->response = $responseJSON;
			throw $exception;
		}
		foreach($response->couriers as $courierResponse)
		{
			$courier = new \Religisaci\Baselinker\Model\Courier();
			$courier->code = (string)$courierResponse->code;
			$courier->name = (string)$courierResponse->name;
			$couriers[] = $courier;
		}

		return $couriers;
	}

	public function getCourierFields(?GetCourierFields $params = NULL): \stdClass
	{
		$responseJSON = (string)$this->client->post('getCourierFields', $params ? $params->getParams() : []);
		$response = json_decode($responseJSON);
		if(!$response || !isset($response->status) || $response->status != 'SUCCESS')
		{
			$exception = new ResponseException("Bad response. Response body:\n" . var_export($response, TRUE));
			$exception->response = $responseJSON;
			throw $exception;
		}
		unset($response->status);

		return $response;
	}
}