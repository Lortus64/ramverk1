<?php

return [

    "services" => [
        "ipcnfg" => [
            "shared" => true,
            "active" => false,
            "callback" => function () {
                $ip = new \Anax\Ip\Ip();
                
                $cnfg = $this->get("configuration");
                $config = $cnfg->load("apikey.php");
                $settings = $config["config"] ?? null;

                if ($settings["url"] ?? null) {
                    $ip->setApi($settings["url"], $settings["key"]);
                }
                return $ip;
            }
        ],
    ],
];
