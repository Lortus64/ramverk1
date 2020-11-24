<?php

namespace Anax\Controller;

use Anax\Commons\ContainerInjectableInterface;
use Anax\Commons\ContainerInjectableTrait;

//use Anax\Route\Exception\NotFoundException;

/**
 * A controller to ease with development and debugging information.
 */
class IpvalidatorController implements ContainerInjectableInterface
{
    use ContainerInjectableTrait;


    /**
     * Render view ip_validator.
     */
    public function indexAction() : object
    {
        $page = $this->di->get("page");
        $page->add(
            "../view/ip_validator/index",
            [
                "result" => "",
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


        if (filter_var($ip, FILTER_VALIDATE_IP)) {
            $ip4 = "Valid";
        } else {
            $ip4 = "Not valid";
        }

        if (filter_var($ip, FILTER_VALIDATE_IP, FILTER_FLAG_IPV6)) {
            $ip6 = "Valid";
        } else {
            $ip6 = "Not valid";
        }

        if ($ip4 == "Valid" || $ip6 == "Valid") {
            $hostname = gethostbyaddr($ip);
        } else {
            $hostname = "No host";
        }


        $result = [
            "ip" => $ip,
            "ip4" => $ip4,
            "ip6" => $ip6,
            "hostname" => $hostname,
        ];


        $page = $this->di->get("page");
        $page->add(
            "../view/ip_validator/index",
            [
                "result" => $result
            ]
        );

        return $page->render([
            "title" => "Ip validator"
        ]);
    }
}
