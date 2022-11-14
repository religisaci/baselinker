<?php

namespace Religisaci\Baselinker\Model;

class OrderProduct
{
	public int $order_id;
	public ?int $order_product_id;
	public ?string $storage;
	public ?string $storage_id;
	public ?string $product_id;
	public ?string $variant_id;
	public ?string $auction_id;
	public ?string $name;
	public ?string $sku;
	public ?string $ean;
	public ?string $location;
	public ?int $warehouse_id;
	public ?string $attributes;
	public ?float $price_brutto;
	public ?float $tax_rate;
	public ?int $quantity;
	public ?float $weight;
}