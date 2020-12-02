<?php
/**
 * Route for ip test
 */

return [
    "routes" => [
        [
            "info" => "ip location.",
            "mount" => "iplocation",
            "handler" => "\Anax\Controller\IpLocationController",
        ],
        [
            "info" => "ip location REST API.",
            "mount" => "iplocationREST",
            "handler" => "\Anax\Controller\IpLocationRestController",
        ],
    ],
];
