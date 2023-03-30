<?php

namespace Religisaci\Baselinker\Api;

use Religisaci\Baselinker\Exception\ResponseException;
use Religisaci\Baselinker\Api\RequestParams\GetOrdersParams;
use Religisaci\Baselinker\Model\OrderProduct;

class Order
{
	private Client $client;

	/**
	 * @param Client $client
	 */
	public function __construct(Client $client)
	{
		$this->client = $client;
	}


	public function getOrders(?GetOrdersParams $params = NULL): array
	{
		$orders = [];
		$responseJSON = (string)$this->client->post('getOrders', $params ? $params->getParams() : []);
		$response = json_decode($responseJSON);
		if(!$response || !isset($response->status) || $response->status != 'SUCCESS')
		{
			$exception = new ResponseException("Bad response. Response body:\n" . var_export($response, TRUE));
			$exception->response = $responseJSON;
			throw $exception;
		}

		foreach($response->orders as $orderResponse)
		{
			$order = new \Religisaci\Baselinker\Model\Order();
			$order->order_id = (int)$orderResponse->order_id;
			$order->shop_order_id = (int)$orderResponse->shop_order_id;
			$order->external_order_id = (string)$orderResponse->external_order_id;
			$order->order_source = (string)$orderResponse->order_source;
			$order->order_source_id = (int)$orderResponse->order_source_id;
			$order->order_source_info = (string)$orderResponse->order_source_info;
			$order->order_status_id = (int)$orderResponse->order_status_id;
			$order->date_add = (int)$orderResponse->date_add;
			$order->date_confirmed = (int)$orderResponse->date_confirmed;
			$order->date_in_status = (int)$orderResponse->date_in_status;
			$order->confirmed = (bool)$orderResponse->confirmed;
			$order->user_login = (string)$orderResponse->user_login;
			$order->currency = (string)$orderResponse->currency;
			$order->payment_method = (string)$orderResponse->payment_method;
			$order->payment_method_cod = (bool)$orderResponse->payment_method_cod;
			$order->payment_done = (float)$orderResponse->payment_done;
			$order->user_comments = (string)$orderResponse->user_comments;
			$order->admin_comments = (string)$orderResponse->admin_comments;
			$order->email = (string)$orderResponse->email;
			$order->phone = (string)$orderResponse->phone;
			$order->delivery_method = (string)$orderResponse->delivery_method;
			$order->delivery_price = (float)$orderResponse->delivery_price;
			$order->delivery_package_module = (string)$orderResponse->delivery_package_module;
			$order->delivery_package_nr = (string)$orderResponse->delivery_package_nr;
			$order->delivery_fullname = (string)$orderResponse->delivery_fullname;
			$order->delivery_company = (string)$orderResponse->delivery_company;
			$order->delivery_address = (string)$orderResponse->delivery_address;
			$order->delivery_postcode = (string)$orderResponse->delivery_postcode;
			$order->delivery_city = (string)$orderResponse->delivery_city;
			$order->delivery_country = (string)$orderResponse->delivery_country;
			$order->delivery_country_code = (string)$orderResponse->delivery_country_code;
			$order->delivery_point_id = (string)$orderResponse->delivery_point_id;
			$order->delivery_point_name = (string)$orderResponse->delivery_point_name;
			$order->delivery_point_address = (string)$orderResponse->delivery_point_address;
			$order->delivery_point_postcode = (string)$orderResponse->delivery_point_postcode;
			$order->delivery_point_city = (string)$orderResponse->delivery_point_city;
			$order->invoice_fullname = (string)$orderResponse->invoice_fullname;
			$order->invoice_company = (string)$orderResponse->invoice_company;
			$order->invoice_nip = (string)$orderResponse->invoice_nip;
			$order->invoice_address = (string)$orderResponse->invoice_address;
			$order->invoice_postcode = (string)$orderResponse->invoice_postcode;
			$order->invoice_city = (string)$orderResponse->invoice_city;
			$order->invoice_country = (string)$orderResponse->invoice_country;
			$order->invoice_country_code = (string)$orderResponse->invoice_country_code;
			$order->want_invoice = (bool)$orderResponse->want_invoice;
			$order->extra_field_1 = (string)$orderResponse->extra_field_1;
			$order->extra_field_2 = (string)$orderResponse->extra_field_2;
			$order->custom_extra_fields = (array)$orderResponse->custom_extra_fields;
			$order->order_page = (string)$orderResponse->order_page;
			$order->pick_state = (int)$orderResponse->pick_state;
			$order->pack_state = (int)$orderResponse->pack_state;

			foreach($orderResponse->products as $orderProductResponse)
			{
				$orderProduct = new OrderProduct();
				$orderProduct->order_id = (int)$orderResponse->order_id;
				$orderProduct->storage = (string)$orderProductResponse->storage;
				$orderProduct->storage_id = (int)$orderProductResponse->storage_id;
				$orderProduct->order_product_id = (int)$orderProductResponse->order_product_id;
				$orderProduct->product_id = (string)$orderProductResponse->product_id;
				$orderProduct->variant_id = (string)$orderProductResponse->variant_id;
				$orderProduct->name = (string)$orderProductResponse->name;
				$orderProduct->sku = (string)$orderProductResponse->sku;
				$orderProduct->ean  = (string)$orderProductResponse->ean ;
				$orderProduct->location  = (string)$orderProductResponse->location ;
				$orderProduct->warehouse_id  = (int)$orderProductResponse->warehouse_id ;
				$orderProduct->auction_id  = (string)$orderProductResponse->auction_id ;
				$orderProduct->attributes  = (string)$orderProductResponse->attributes ;
				$orderProduct->price_brutto  = (float)$orderProductResponse->price_brutto ;
				$orderProduct->tax_rate  = (float)$orderProductResponse->tax_rate ;
				$orderProduct->quantity  = (int)$orderProductResponse->quantity ;
				$orderProduct->weight  = (float)$orderProductResponse->weight ;
				$orderProduct->bundle_id  = (int)$orderProductResponse->bundle_id ;

				$order->addProduct($orderProduct);
			}
			$orders[] = $order;
		}

		return $orders;
	}

	public function getOrderStatusList():array
	{
		$orderStatuses = [];
		$responseJSON = (string)$this->client->post('getOrderStatusList');
		$response = json_decode($responseJSON);
		if(!$response || !isset($response->status) || $response->status != 'SUCCESS')
		{
			$exception = new ResponseException("Bad response. Response body:\n" . var_export($response, TRUE));
			$exception->response = $responseJSON;
			throw $exception;
		}
		foreach($response->statuses as $orderStatusesResponse)
		{
			$orderStatus = new \Religisaci\Baselinker\Model\OrderStatus();
			$orderStatus->id = (int)$orderStatusesResponse->id;
			$orderStatus->name = (string)$orderStatusesResponse->name;
			$orderStatus->name_for_customer = (string)$orderStatusesResponse->name_for_customer;
			$orderStatuses[] = $orderStatus;
		}


		return $orderStatuses;
	}

	public function setOrderStatus(int $orderId, int $statusId): bool
	{
		$responseJSON = (string)$this->client->post('setOrderStatus', ['order_id' => $orderId, 'status_id' => $statusId]);
		$response = json_decode($responseJSON);
		if(!$response || !isset($response->status) || $response->status != 'SUCCESS')
		{
			$exception = new ResponseException("Bad response. Response body:\n" . var_export($response, TRUE));
			$exception->response = $responseJSON;
			throw $exception;
		}

		return TRUE;
	}
}