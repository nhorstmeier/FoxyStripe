<?php
/**
 *
 * @package FoxyStripe
 *
 */

class OrderHistoryPage extends Page {

    private static $singular_name = 'Order History Page';
    private static $plural_name = 'Order History Pages';
    private static $description = 'Show a customers past orders. Requires authentication';

	public function getCMSFields(){
		$fields = parent::getCMSFields();



		$this->extend('updateCMSFields', $fields);
		return $fields;
	}

    // return all current Member's Orders
    public function getOrders($limit = 10) {
        if ($Member = Member::currentUser()) {
            $Orders = $Member->Orders()->sort('TransactionDate', 'DESC');

            $list = new PaginatedList($Orders, Controller::curr()->request);
            $list->setPageLength($limit);
            return $list;
        }
        return false;
    }

}

class OrderHistoryPage_Controller extends Page_Controller {
	
	private static $allowed_actions = array(
        'index'
    );

    public function checkMember() {
        if(Member::currentUser()) {
            return true;
        } else {
            return Security::permissionFailure ($this, _t (
                'AccountPage.CANNOTCONFIRMLOGGEDIN',
                'Please login to view this page.'
            ));
        }
    }

    public function Index() {

        $this->checkMember();
        return array();

    }


}