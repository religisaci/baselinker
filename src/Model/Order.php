<?php

namespace Religisaci\Baselinker\Model;

class Order
{
	public ?int $order_id;
	public ?int $shop_order_id;
	public ?string $external_order_id;
	public ?string $order_source;
	public ?int $order_source_id;
	public ?string $order_source_info;
	public ?int $order_status_id;
	public ?int $date_add;
	public ?int $date_confirmed;
	public ?int $date_in_status;
	public ?bool $confirmed;
	public ?string $user_login;
	public ?string $currency;
	public ?string $payment_method;
	public ?bool $payment_method_cod;
	public ?float $payment_done;
	public ?string $user_comments;
	public ?string $admin_comments;
	public ?string $email;
	public ?string $phone;
	public ?string $delivery_method;
	public ?float $delivery_price;
	public ?string $delivery_package_module;
	public ?string $delivery_package_nr;
	public ?string $delivery_fullname;
	public ?string $delivery_company;
	public ?string $delivery_address;
	public ?string $delivery_postcode;
	public ?string $delivery_city;
	public ?string $delivery_country;
	public ?string $delivery_country_code;
	public ?string $delivery_point_id;
	public ?string $delivery_point_name;
	public ?string $delivery_point_address;
	public ?string $delivery_point_postcode;
	public ?string $delivery_point_city;
	public ?string $invoice_fullname;
	public ?string $invoice_company;
	public ?string $invoice_nip;
	public ?string $invoice_address;
	public ?string $invoice_postcode;
	public ?string $invoice_city;
	public ?string $invoice_country;
	public ?string $invoice_country_code;
	public ?bool $want_invoice;
	public ?string $extra_field_1;
	public ?string $extra_field_2;
	public ?array $custom_extra_fields;
	public ?string $order_page;
	public ?int $pick_state;
	public ?int $pack_state;
	private array $products = [];

	public function addProduct(OrderProduct $orderProduct)
	{
		$this->products[$orderProduct->order_product_id] = $orderProduct;
	}

	public function getProducts():array
	{
		return $this->products;
	}
}