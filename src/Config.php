<?php

namespace Religisaci\Baselinker;

use Religisaci\Baselinker\Exception\InvalidParameterException;

class Config
{
	private array $config = [
		'token' => NULL,
		'waitIfBlockedToken' => FALSE,
	];

	/**
	 * @param array $configs
	 * @throws InvalidParameterException
	 */
	public function __construct(array $configs)
	{
		$this->setConfigs($configs);
	}

	/**
	 * @param array $configs
	 * @return void
	 * @throws InvalidParameterException
	 */
	private function setConfigs(array $configs): void
	{
		if(!key_exists('token', $configs) || !$configs['token'])
		{
			throw new InvalidParameterException('Parameter "token" is mandatory.');
		}

		foreach($configs as $configName => $value)
		{
			if(key_exists($configName, $this->config))
			{
				$this->config[$configName] = $value;
			}
			else
			{
				throw new InvalidParameterException(sprintf("Parameter \"%s\" is not allowed.", $configName));
			}
		}
	}

	/**
	 * @param string $configName
	 * @return mixed|null
	 * @throws InvalidParameterException
	 */
	public function getConfigValue(string $configName)
	{
		if(key_exists($configName, $this->config))
		{
			return $this->config[$configName];
		}

		throw new InvalidParameterException(sprintf("Parameter \"%s\" is not allowed.", $configName));
	}

	public function setConfig(string $configName, $value): void
	{

	}
}