<?php

return [
    "services" => [
        "ip" => [
            "shared" => true,
            "active" => false,
            "callback" => function () {
                $ip = new \Anax\Ip\Ip();

                return $ip;
            }
        ],
    ],
];
