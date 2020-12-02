<?php

namespace Anax\Controller;

use Anax\Commons\ContainerInjectableInterface;
use Anax\Commons\ContainerInjectableTrait;
use Anax\Ip\Ip;

//use Anax\Route\Exception\NotFoundException;

/**
 * A controller to ease with development and debugging information.
 */
class IpLocationController implements ContainerInjectableInterface
{
    use ContainerInjectableTrait;


    /**
     * Render view ip_validator.
     */
    public function indexAction() : object
    {
        $ipinfo = $this->di->get("ipcnfg");

        $clientip = $ipinfo->getClientIp();

        $page = $this->di->get("page");
        $page->add(
            "../view/ip_location/index",
            [
                "result" => "",
                "clientip" => $clientip,
            ]
        );

        return $page->render([
            "title" => "Ip validator"
        ]);
    }


    /**
     * This is the index method action, it handles:
     * GET METHOD mountpoint
     * GET METHOD mountpoint/
     * GET METHOD mountpoint/index
     *
     * @return array
     */
    public function indexActionPost() : object
    {
        // Deal with the action and return a response.
        try {
            $ip = $this->di->request->getPost("ip");
        } catch (\Exeption $e) {
            $ip = "Body is missing!";
        }


        $ipinfo = $this->di->get("ipcnfg");

        $result = $ipinfo -> valid($ip);

        if ($result["ip4"] == "Valid") {
            $result = $ipinfo -> location($ip);
        } else {
            $result = [
                "ip" => $ip,
                "type" => "Not valid",
                "country_name" => "None",
                "city" => "None",
            ];
        }


        $clientip = $ipinfo->getClientIp();

        $page = $this->di->get("page");
        $page->add(
            "../view/ip_location/index",
            [
                "result" => $result,
                "clientip" => $clientip,
            ]
        );

        return $page->render([
            "title" => "Ip validator"
        ]);
    }
}
