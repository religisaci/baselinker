<?php

namespace Religisaci\Baselinker\Api;

use GuzzleHttp\Psr7\Response;
use GuzzleHttp\RequestOptions;
use ReligisCore\BaselinkerConnector\Exception\BlockedToken;

class Client
{
	private string $token;
	private \GuzzleHttp\Client $client;
	private const  API_URL = 'https://api.baselinker.com/connector.php';
	private int $countOfBlocking = 0;
	private bool $waitIfBlockedToken;

	public function __construct(string $token, bool $waitIfBlockedToken = FALSE)
	{
		$this->token = $token;
		$this->waitIfBlockedToken = $waitIfBlockedToken;
	}


	/**
	 * @param string $method
	 * @param array|null $data
	 * @return Response
	 * @throws BlockedToken
	 */
	public function post(string $method, ?array $data = NULL): Response
	{
		$postData = [
			'method' => $method,
		];
		if(isset($data))
		{
			$postData['parameters'] = json_encode($data);
		}

		do
		{
			$response = $this->getClient()->post('', [
				RequestOptions::FORM_PARAMS => $postData,
			]);

			$responseString = (string)$response;
			$responseData = json_decode($responseString);
			if($this->waitIfBlockedToken === TRUE && $responseData && isset($responseData->status) && isset($responseData->error_code) && isset($responseData->error_message) && $responseData->status == 'ERROR' && $responseData->error_code == 'ERROR_BLOCKED_TOKEN')
			{
				if($this->countOfBlocking > 5)
				{
					throw new BlockedToken('BaselinkerClient: ' . $responseData->error_message);
				}
				//2023-03-30 09:34:29
				if(preg_match('/^.*(\d{4}-\d{2}-\d{2} \d{2}:\d{2}:\d{2})$/', $responseData->error_message, $matches))
				{
					$this->countOfBlocking++;
					$datetimeEndBlocking = $matches[1];
					$datetimeEndBlocking = \DateTime::createFromFormat('Y-m-d H:i:s', $datetimeEndBlocking);
					if($datetimeEndBlocking)
					{
						$now = new DateTime();
						$timeFormWaiting = $datetimeEndBlocking->format('U') - $now->format('U');
						sleep($timeFormWaiting + 10);
						continue;
					}
				}
			}

			break;
		}
		while(TRUE);


		return $response;
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
					'headers' => ['X-BLToken' => $this->token],
				]
			);
		}
		return $this->client;
	}

}