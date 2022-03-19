<?php
    include 'config.php';

    $status = json_decode(file_get_contents('https://api.mcsrvstat.us/2/' . $config['serverTitle']));

    $serverStatus = (object) [
        "online" => false,
        "version" => "",
        "onlinePlayer" => 0,
        "maxPlayer" => 0,
        "motd" => ""
    ];

    if ($status->debug->ping == true) { //If Server is Online
        $serverStatus->online = true;
        $serverStatus->version = $status->version;
        $serverStatus->onlinePlayer = $status->players->online;
        $serverStatus->maxPlayer = $status->players->max;
        $serverStatus->motd = $status->motd->html;
    } else {                            //If Server is Offline
        $serverStatus->online = false;
    }
?>