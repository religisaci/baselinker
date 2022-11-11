<?php

namespace Religisaci\Baselinker\Model;

class InventoryProduct
{
	public ?string $inventory_id;
	public ?string $product_id;
	public ?string $parent_id;
	public ?int $manufacturer_id;
	public ?int $category_id;
	public ?bool $is_bundle;
	public ?string $ean;
	public ?string $sku;
	public ?string $name;
	public ?float $tax_rate;
	public ?float $weight;
	public ?float $height;
	public ?float $width;
	public ?float $length;
	public ?int $star;
	public ?array $prices;
	public ?array $stock;
	public ?array $locations;
	public ?array $text_fields;
	public ?\stdClass $images;
	public ?array $links;
	public ?array $bundle_products;
	public ?float $average_cost;
	public ?float $average_landed_cost;
	public ?array $variants;

	public function addName(string $text, ?string $language = NULL, ?string $service = NULL, ?int $serviceId = NULL)
	{
		if(!isset($language))
		{
			$this->name = $text;
		}
		$this->addTextField('name', $text, $language, $service, $serviceId);
	}

	public function addDescription(string $text, ?string $language = NULL, ?string $service = NULL, ?int $serviceId = NULL)
	{
		$this->addTextField('description', $text, $language, $service, $serviceId);
	}

	public function addDescriptionExtra1(string $text, ?string $language = NULL, ?string $service = NULL, ?int $serviceId = NULL)
	{
		$this->addTextField('description_extra1', $text, $language, $service, $serviceId);
	}

	public function addDescriptionExtra2(string $text, ?string $language = NULL, ?string $service = NULL, ?int $serviceId = NULL)
	{
		$this->addTextField('description_extra2', $text, $language, $service, $serviceId);
	}

	public function addDescriptionExtra3(string $text, ?string $language = NULL, ?string $service = NULL, ?int $serviceId = NULL)
	{
		$this->addTextField('description_extra3', $text, $language, $service, $serviceId);
	}

	public function addDescriptionExtra4(string $text, ?string $language = NULL, ?string $service = NULL, ?int $serviceId = NULL)
	{
		$this->addTextField('description_extra4', $text, $language, $service, $serviceId);
	}

	public function addFeatures(string $text, ?string $language = NULL, ?string $service = NULL, ?int $serviceId = NULL)
	{
		$this->addTextField('features', $text, $language, $service, $serviceId);
	}

	public function addTextField(string $textFiled, string $text, ?string $language = NULL, ?string $service = NULL, ?int $serviceId = NULL)
	{
		$key = $textFiled;
		if(isset($language))
		{
			$key .= '|'.$language;

			if(isset($service))
			{
				$key .= '|'.$service;

				if(!isset($serviceId))
				{
					$serviceId = 0;
				}
				$key .= '_'.$serviceId;
			}
		}
		$this->text_fields[$key] = $text;
	}

	public function getData(): array
	{
		$data = [
			'inventory_id' => $this->inventory_id,
			'name' => $this->name,
		];
		if(isset($this->parent_id))
		{
			$data['parent_id'] = $this->parent_id;
		}

		if(isset($this->manufacturer_id))
		{
			$data['manufacturer_id'] = $this->manufacturer_id;
		}

		if(isset($this->category_id))
		{
			$data['category_id'] = $this->category_id;
		}

		if(isset($this->is_bundle))
		{
			$data['is_bundle'] = $this->is_bundle;
		}

		if(isset($this->ean))
		{
			$data['ean'] = $this->ean;
		}

		if(isset($this->sku))
		{
			$data['sku'] = $this->sku;
		}

		if(isset($this->tax_rate))
		{
			$data['tax_rate'] = $this->tax_rate;
		}

		if(isset($this->weight))
		{
			$data['weight'] = $this->weight;
		}

		if(isset($this->height))
		{
			$data['height'] = $this->height;
		}

		if(isset($this->width))
		{
			$data['width'] = $this->width;
		}

		if(isset($this->length))
		{
			$data['length'] = $this->length;
		}

		if(isset($this->star))
		{
			$data['star'] = $this->star;
		}

		if(isset($this->prices))
		{
			$data['prices'] = $this->prices;
		}

		if(isset($this->stock))
		{
			$data['stock'] = $this->stock;
		}

		if(isset($this->locations))
		{
			$data['locations'] = $this->locations;
		}

		if(isset($this->text_fields))
		{
			$data['text_fields'] = $this->text_fields;
		}

		if(isset($this->images))
		{
			$data['images'] = $this->images;
		}

		if(isset($this->links))
		{
			$data['links'] = $this->links;
		}

		if(isset($this->bundle_products))
		{
			$data['bundle_products'] = $this->bundle_products;
		}

		if(isset($this->average_cost))
		{
			$data['average_cost'] = $this->average_cost;
		}

		if(isset($this->average_landed_cost))
		{
			$data['average_landed_cost'] = $this->average_landed_cost;
		}

		if(isset($this->variants))
		{
			$data['variants'] = $this->variants;
		}
		return $data;
	}
}