<?php
/**
 * Route for ip test
 */

return [
    "routes" => [
        [
            "info" => "ip validate.",
            "mount" => "ipvalidate",
            "handler" => "\Anax\Controller\IpvalidatorController",
        ],
        [
            "info" => "ip validate REST API.",
            "mount" => "ipvalidateREST",
            "handler" => "\Anax\Controller\IpvalidatorRestController",
        ],
    ],
];
