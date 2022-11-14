<?php

namespace Religisaci\Baselinker\Api\RequestParams;

use Religisaci\Baselinker\Exception\InvalidParameterException;

class GetOrdersParams
{
	public ?int $order_id;
	public ?int $date_confirmed_from;
	public ?int $date_from;
	public ?int $id_from;
	public ?bool $get_unconfirmed_orders;
	public ?bool $include_custom_extra_fields;
	public ?int $status_id;
	public ?string $filter_email;
	public ?string $filter_order_source;
	public ?int $filter_order_source_id;

	public function getParams(): array
	{
		$params = [];

		if(isset($this->order_id))
		{
			$params['order_id'] = $this->order_id;
		}

		if(isset($this->date_confirmed_from))
		{
			$params['date_confirmed_from'] = $this->date_confirmed_from;
		}

		if(isset($this->date_from))
		{
			$params['date_from'] = $this->date_from;
		}

		if(isset($this->id_from))
		{
			$params['id_from'] = $this->id_from;
		}

		if(isset($this->get_unconfirmed_orders))
		{
			$params['get_unconfirmed_orders'] = $this->get_unconfirmed_orders;
		}

		if(isset($this->include_custom_extra_fields))
		{
			$params['include_custom_extra_fields'] = $this->include_custom_extra_fields;
		}

		if(isset($this->status_id))
		{
			$params['status_id'] = $this->status_id;
		}

		if(isset($this->filter_email))
		{
			$params['filter_email'] = $this->filter_email;
		}

		if(isset($this->filter_order_source))
		{
			$params['filter_order_source'] = $this->filter_order_source;
		}

		if(isset($this->filter_order_source_id))
		{
			$params['filter_order_source_id'] = $this->filter_order_source_id;
		}

		return $params;
	}
}