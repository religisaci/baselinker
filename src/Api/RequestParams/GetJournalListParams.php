<?php

namespace Religisaci\Baselinker\Api\RequestParams;

use Religisaci\Baselinker\Exception\InvalidParameterException;

class GetJournalListParams
{
	public ?int $last_log_id;
	public ?array $logs_types;
	public ?int $order_id;

	public function getParams(): array
	{
		$params = [];

		if(isset($this->last_log_id))
		{
			$params['last_log_id'] = $this->last_log_id;
		}

		if(isset($this->logs_types))
		{
			$params['logs_types'] = $this->logs_types;
		}

		if(isset($this->order_id))
		{
			$params['order_id'] = $this->order_id;
		}

		return $params;
	}
}
