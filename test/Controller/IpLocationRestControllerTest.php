<?php

namespace Anax\Controller;

use Anax\DI\DIFactoryConfig;
use PHPUnit\Framework\TestCase;
use GuzzleHttp\Client;

/**
 * Test the SampleJsonController.
 */
class IpLocationRestControllerTest extends TestCase
{
    
    // Create the di container.
    protected $di;
    protected $controller;


        /**
     * Prepare before each test.
     */
    protected function setUp()
    {
        global $di;

        // Setup di
        $this->di = new DIFactoryConfig();
        $this->di->loadServices(ANAX_INSTALL_PATH . "/config/di");

        // Use a different cache dir for unit test
        $this->di->get("cache")->setPath(ANAX_INSTALL_PATH . "/test/cache");

        // View helpers uses the global $di so it needs its value
        $di = $this->di;

        // Setup the controller
        $this->controller = new IpLocationRestController();
        $this->controller->setDI($this->di);
        //$this->controller->initialize();
    }


    public function testIndexActionPost()
    {

        $ch = curl_init();

        curl_setopt(
            $ch,
            CURLOPT_URL,
            "http://localhost:8080/dbwebb/ramverk1/me/redovisa/htdocs/iplocationREST"
        );
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        //TEST ip6
        curl_setopt(
            $ch,
            CURLOPT_POSTFIELDS,
            "ip=2001:4860:4860::8888"
        );
        $res = curl_exec($ch);
        //$res = $this->controller->indexActionPost();

        //$res = file_get_contents($url);
        $res = json_decode(
            $res,
            true
        );

        $exp1 = "ipv6";
        $exp2 = "United States";
        $exp3 = "Mountain View";

        $this->assertContains($exp1, $res["type"]);
        $this->assertContains($exp2, $res["country_name"]);
        $this->assertContains($exp3, $res["city"]);

        //TEST ip4
        curl_setopt(
            $ch,
            CURLOPT_POSTFIELDS,
            "ip=8.8.8.8"
        );
        $res = curl_exec($ch);
        $res = json_decode(
            $res,
            true
        );

        $exp1 = "ipv4";
        $exp2 = "United States";
        $exp3 = "Mountain View";

        $this->assertContains($exp1, $res["type"]);
        $this->assertContains($exp2, $res["country_name"]);
        $this->assertContains($exp3, $res["city"]);


        //TEST no body
        curl_setopt(
            $ch,
            CURLOPT_POSTFIELDS,
            ""
        );
        $res = curl_exec($ch);

        $res = json_decode(
            $res,
            true
        );

        $exp1 = "Not valid";
        $exp2 = "None";
        $exp3 = "None";

        $this->assertContains($exp1, $res["type"]);
        $this->assertContains($exp2, $res["country_name"]);
        $this->assertContains($exp3, $res["city"]);

        curl_close($ch);
    }
}
