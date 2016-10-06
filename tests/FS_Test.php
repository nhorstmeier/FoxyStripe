<?php

/**
 * Class FS_Test
 */
class FS_Test extends FunctionalTest
{

    /**
     * @var string
     */
    protected static $fixture_file = 'foxystripe/tests/FoxyStripeTest.yml';
    /**
     * @var bool
     */
    protected static $disable_themes = true;
    /**
     * @var bool
     */
    protected static $use_draft_site = false;

    /**
     *
     */
    public function setUp()
    {
        parent::setUp();

        ini_set('display_errors', 1);
        ini_set("log_errors", 1);
        error_reporting(E_ALL & ~E_NOTICE & ~E_DEPRECATED);
    }

    /**
     *
     */
    public function logOut()
    {
        $this->session()->clear('loggedInAs');
    }

    /**
     *
     */
    public function testFoxyStripeProduct()
    {
    }

}
