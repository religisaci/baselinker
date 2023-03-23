<?php

namespace Religisaci\Baselinker\Model;

class PackageManual
{
	public int $order_id;
	public ?int $package_id;
	public string $courier_code;
	public ?string $package_number;
	public ?int $pickup_date;

	public  function getData(): array
	{
		$data = [
			'order_id' => $this->order_id,
			'courier_code' => $this->courier_code,
			'package_number' => $this->package_number,
			'pickup_date' => $this->pickup_date,
		];
		return $data;
	}
}