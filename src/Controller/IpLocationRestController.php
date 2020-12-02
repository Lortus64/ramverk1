<?php

namespace Anax\Controller;

use Anax\Commons\ContainerInjectableInterface;
use Anax\Commons\ContainerInjectableTrait;
use Anax\Ip\Ip;

//use Anax\Route\Exception\NotFoundException;

/**
 * A controller to ease with development and debugging information.
 */
class IpLocationRestController implements ContainerInjectableInterface
{
    use ContainerInjectableTrait;

    /**
     * This is the index method action, it handles:
     * GET METHOD mountpoint
     * GET METHOD mountpoint/
     * GET METHOD mountpoint/index
     *
     * @return array
     */
    public function indexActionPost() : array
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

            $result = [
                "ip" => $ip,
                "type" => $result["type"],
                "country_name" => $result["country_name"],
                "city" => $result["city"],
            ];
        } else {
            $result = [
                "ip" => $ip,
                "type" => "Not valid",
                "country_name" => "None",
                "city" => "None",
            ];
        }

        return [$result];
    }
}
