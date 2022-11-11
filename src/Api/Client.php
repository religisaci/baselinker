<?php

namespace Religisaci\Baselinker\Api;

use GuzzleHttp\Psr7\Request;
use GuzzleHttp\Psr7\Response;
use GuzzleHttp\RequestOptions;

class Client
{
	private string $token;
	private \GuzzleHttp\Client $client;
	private const  API_URL = 'https://api.baselinker.com/connector.php';

	public function __construct(string $token)
	{
		$this->token = $token;
	}


	public function post(string $method, ?array $data = NULL): Response
	{
		$postData = [
			'method' => $method,
		];
		if(isset($data))
		{
			$postData['parameters'] = json_encode($data);
		}
		return $this->getClient()->post('', [
			RequestOptions::FORM_PARAMS => $postData
		]);
	}

	private function getClient(): \GuzzleHttp\Client
	{
		if(!isset($this->client))
		{
			$this->client = new \GuzzleHttp\Client(
				[
					'base_uri' => Client::API_URL,
					'timeout' => 0,
					'allow_redirects' => FALSE,
					'headers' => ['X-BLToken' => $this->token]
				]
			);
		}
		return $this->client;
	}

}