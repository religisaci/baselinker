<?php

namespace Religisaci\Baselinker\Api;

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
		$responseJSON = (string)$this->client->post('createPackageManual', $packageManual->getData())->getBody();
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
		$responseJSON = (string)$this->client->post('getCouriersList')->getBody();
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
}