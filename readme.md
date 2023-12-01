Baselinker.com connector
=====================

API connector of the baselinker API: https://api.baselinker.com/index.php

## Installation
```bash
composer require religisaci/baselinker
```

## Example Usage
```php
$baselinker = new Baselinker(['token' => 'API-TOKEN']);
// Create a category:
$category = new InventoryCategory();
$category->name = 'Category Name';
$category->inventory_id = 12345;
$category->parent_id = 0;
$baselinker->InventoryCategory()->addInventoryCategory($category);
```

## API method implementations
Overview of the implemented methods, listed on https://api.baselinker.com/index.php

### Product catalog
| Method                             | Status |
|------------------------------------|--------|
| addInventoryPriceGroup             |        |
| deleteInventoryPriceGroup          |        |
| getInventoryPriceGroups            | X      |
| addInventoryWarehouse              | X      |
| deleteInventoryWarehouse           | X      |
| getInventoryWarehouses             | X      |
| addInventory                       | X      |
| deleteInventory                    | X      |
| getInventories                     | X      |
| addInventoryCategory               | X      |
| deleteInventoryCategory            | X      |
| getInventoryCategories             | X      |
| addInventoryManufacturer           | X      |
| deleteInventoryManufacturer        | X      |
| getInventoryManufacturers          | X      |
| getInventoryExtraFields            |        |
| getInventoryIntegrations           |        |
| getInventoryAvailableTextFieldKeys | X      |
| addInventoryProduct                | X      |
| deleteInventoryProduct             | X      |
| getInventoryProductsData           | X      |
| getInventoryProductsList           | X      |
| getInventoryProductsStock          |        |
| updateInventoryProductsStock       | X      |
| getInventoryProductsPrices         |        |
| updateInventoryProductsPrices      | X      |
| getInventoryProductLogs            |        |
| runProductMacroTrigger             |        |

### External storages
| Method                                | Status |
|---------------------------------------|--------|
| getExternalStoragesList               |        |
| getExternalStorageCategories          |        |
| getExternalStorageProductsData        |        |
| getExternalStorageProductsList        |        |
| getExternalStorageProductsQuantity    |        |
| getExternalStorageProductsPrices      |        |
| updateExternalStorageProductsQuantity |        |

### Orders
| Method                     | Status |
|----------------------------|--------|
| getJournalList             |        |
| addOrder                   |        |
| getOrderSources            |        |
| getOrderExtraFields        |        |
| getOrders                  | X      |
| getOrderTransactionDetails |        |
| getOrdersByEmail           |        |
| getOrdersByPhone           |        |
| addInvoice                 |        |
| getInvoices                |        |
| getSeries                  |        |
| getOrderStatusList         | X      |
| getOrderPaymentsHistory    |        |
| getNewReceipts             |        |
| getReceipt                 |        |
| setOrderFields             |        |
| addOrderProduct            |        |
| setOrderProductFields      |        |
| deleteOrderProduct         |        |
| setOrderPayment            |        |
| setOrderStatus             |        |
| setOrderStatuses           |        |
| setOrderReceipt            |        |
| addOrderInvoiceFile        |        |
| addOrderReceiptFile        |        |
| getInvoiceFile             |        |
| runOrderMacroTrigger       |        |

### Courier shipments
| Method                          | Status |
|---------------------------------|--------|
| createPackage                   |        |
| createPackageManual             | X      |
| getCouriersList                 | X      |
| getCourierFields                | X      |
| getCourierServices              |        |
| getCourierAccounts              |        |
| getLabel                        |        |
| getProtocol                     |        |
| getOrderPackages                |        |
| getCourierPackagesStatusHistory |        |
| deleteCourierPackage            |        |
| requestParcelPickup             |        |
| getRequestParcelPickupFields    |        |
