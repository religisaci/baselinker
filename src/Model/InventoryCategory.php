<?php

namespace Baselinker\Model;

class InventoryCategory
{
	public int $inventory_id;
	public ?int $category_id;
	public string $name;
	public ?int $parent_id;
}