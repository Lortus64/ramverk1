<?php

namespace Anax\Controller;

use Anax\Commons\ContainerInjectableInterface;
use Anax\Commons\ContainerInjectableTrait;
use Anax\Ip\Ip;

//use Anax\Route\Exception\NotFoundException;

/**
 * A controller to ease with development and debugging information.
 */
class IpvalidatorRestController implements ContainerInjectableInterface
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

        $validip = new ip();
        $result = $validip-> valid($ip);

        return [$result];
    }
}
