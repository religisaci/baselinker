<?php

namespace Religisaci\Baselinker\Api;

use GuzzleHttp\RequestOptions;
use Psr\Http\Message\StreamInterface;
use Religisaci\Baselinker\Exception\BlockedToken;

class Client
{
	private string $token;
	private \GuzzleHttp\Client $client;
	private const  API_URL = 'https://api.baselinker.com/connector.php';
	private int $countOfBlocking = 0;
	private bool $waitIfBlockedToken;
	private int $limitRequestPerMinute;
	private int $currentMinute;
	private int $requestInMinute = 0;

	public function __construct(string $token, bool $waitIfBlockedToken = FALSE, $limitRequestPerMinute = 100)
	{
		$this->token = $token;
		$this->waitIfBlockedToken = $waitIfBlockedToken;
		$this->limitRequestPerMinute = $limitRequestPerMinute;
		$this->currentMinute = (int)date('i');
	}


	/**
	 * @param string $method
	 * @param array|null $data
	 * @return StreamInterface
	 * @throws BlockedToken
	 */
	public function post(string $method, ?array $data = NULL): StreamInterface
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
			$this->waitForNewSetOfRequests();

			$response = $this->getClient()->post('', [
				RequestOptions::FORM_PARAMS => $postData,
			])->getBody();

			$responseData = json_decode((string)$response);
			if($this->waitIfBlockedToken === TRUE && $responseData && isset($responseData->status) && isset($responseData->error_code) && isset($responseData->error_message) && $responseData->status == 'ERROR' && $responseData->error_code == 'ERROR_BLOCKED_TOKEN')
			{
				if($this->countOfBlocking > 5)
				{
					throw new BlockedToken('BaselinkerClient: ' . $responseData->error_message);
				}

				if(preg_match('/^.*(\d{4}-\d{2}-\d{2} \d{2}:\d{2}:\d{2})$/', $responseData->error_message, $matches))
				{
					$this->countOfBlocking++;
					$datetimeEndBlocking = $matches[1];
					$datetimeEndBlocking = \DateTime::createFromFormat('Y-m-d H:i:s', $datetimeEndBlocking);
					if($datetimeEndBlocking)
					{
						$now = new \DateTime();
						$timeForWaiting = $datetimeEndBlocking->format('U') - $now->format('U');
						// default blocking time is 10 minutes
						if($timeForWaiting > 660)
						{
							throw new BlockedToken('BaselinkerClient: ' . $responseData->error_message);
						}
						sleep($timeForWaiting + 10);
						continue;
					}
				}
			}

			break;
		} while(TRUE);


		return $response;
	}

	private function waitForNewSetOfRequests()
	{
		$currentMinute = (int)date('i');
		if($this->currentMinute != $currentMinute)
		{
			$this->currentMinute = $currentMinute;
			$this->requestInMinute = 0;
		}
		if($this->requestInMinute > $this->limitRequestPerMinute)
		{
			$sleepTime = 60 - (int)date('s');
			sleep($sleepTime > 0 ? $sleepTime : 1);
			$this->requestInMinute = 0;
		}
		$this->requestInMinute++;
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