<?php

class Order extends DataObject implements PermissionProvider{

	private static $singular_name = 'Order';
	private static $plural_name = 'Orders';
	private static $description = 'Orders from FoxyCart Datafeed';

	private static $db = array(
        'Order_ID' => 'Int',
        'Store_ID' => 'Int',
        'StoreVersion' => 'Varchar',
        'IsTest' => 'Boolean',
        'IsHidden' => 'Boolean',
        'DataIsFed' => 'Boolean',
        'TransactionDate' => 'SS_Datetime',
        'ProcessorResponse' => 'Varchar(200)',
        'ShiptoShippingServiceDescription' => 'Varchar(200)',
        'ProductTotal' => 'Currency',
        'TaxTotal' => 'Currency',
        'ShippingTotal' => 'Currency',
        'OrderTotal' => 'Currency',
        'PaymentGatewayType' => 'Varchar(100)',
        'ReceiptURL' => 'Varchar(255)',
        'OrderStatus' => 'Varchar(255)'
    );

	private static $has_one = array(
        'Member' => 'Member'
    );

	private static $has_many = array(
        'Details' => 'OrderDetail'
    );

	private static $many_many = array(

    );

	private static $many_many_extraFields = array(

    );

	private static $belongs_many_many = array();

	private static $summary_fields = array(
        'Order_ID',
        'TransactionDate.NiceUS',
        'Member.Name',
        'OrderTotal.Nice'
    );

	private static $searchable_fields = array(
        'Order_ID',
        'TransactionDate',
        'Member.Surname',
        'OrderTotal'
    );

    function fieldLabels($includerelations = true) {
        $labels = parent::fieldLabels();

        $labels['Order_ID'] = 'ID';
        $labels['TransactionDate.NiceUS'] = "Date";
        $labels['Member.Name'] = 'Customer';
        $labels['OrderTotal.Nice'] = 'Total';

        return $labels;
    }

	private static $indexes = array();

	public function getCMSFields(){
		$fields = parent::getCMSFields();


		$this->extend('updateCMSFields', $fields);
		return $fields;
	}

	public function canView($member = false) {
		return Permission::check('Product_ORDERS');
	}

	public function canEdit($member = null) {
		return false;
	}

	public function canDelete($member = null) {
		return Permission::check('Product_ORDERS');
	}

	public function canCreate($member = null) {
		return false;
	}

	public function providePermissions() {
		return array(
			'Product_ORDERS' => 'Allow user to manage Orders and related objects'
		);
	}

}