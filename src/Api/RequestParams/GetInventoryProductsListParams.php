<?php

namespace Religisaci\Baselinker\Api\RequestParams;

use Religisaci\Baselinker\Api\Exception\InvalidParameterException;

class GetInventoryProductsListParams
{
	public int $inventory_id;
	public ?int $filter_id;
	public ?int $filter_category_id;
	public ?string $filter_ean;
	public ?string $filter_sku;
	public ?string $filter_name;
	public ?float $filter_price_from;
	public ?float $filter_price_to;
	public ?int $filter_stock_from;
	public ?int $filter_stock_to;
	public ?int $page;
	public ?string $filter_sort;

	public function getParams(): array
	{
		if(!$this->inventory_id || $this->inventory_id <= 0)
		{
			throw new InvalidParameterException("Parameter inventory_id is not valid. Value must by greater then 0.");
		}
		$params = [
			'inventory_id' => $this->inventory_id,
		];

		if(isset($this->filter_id))
		{
			$params['filter_id'] = $this->filter_id;
		}

		if(isset($this->filter_category_id))
		{
			$params['filter_category_id'] = $this->filter_category_id;
		}

		if(isset($this->filter_ean))
		{
			$params['filter_ean'] = $this->filter_ean;
		}

		if(isset($this->filter_sku))
		{
			$params['filter_sku'] = $this->filter_sku;
		}

		if(isset($this->filter_name))
		{
			$params['filter_name'] = $this->filter_name;
		}

		if(isset($this->filter_price_from))
		{
			$params['filter_price_from'] = $this->filter_price_from;
		}

		if(isset($this->filter_price_to))
		{
			$params['filter_price_to'] = $this->filter_price_to;
		}

		if(isset($this->filter_stock_from))
		{
			$params['filter_stock_from'] = $this->filter_stock_from;
		}

		if(isset($this->filter_stock_to))
		{
			$params['filter_stock_to'] = $this->filter_stock_to;
		}

		if(isset($this->page))
		{
			$params['page'] = $this->page;
		}

		if(isset($this->filter_sort))
		{
			$params['filter_sort'] = $this->filter_sort;
		}

		return $params;
	}
}