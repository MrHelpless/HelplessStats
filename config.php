<?php
    $serverDomain   = 'mc.mrhelpless.xyz';                                      //Domain of your MC-Server / example <mc.mrhelpless.xyz>
    $serverVersion  = 'PaperMC 1.18.2';                                         //Version of your MC-Server / example <PaperMC 1.18.2>
    $pathServer     = '/home/mc/paper';                                         //Path where your MC-Server is lokated / example </home/mc/paper> (folder where your server.jar is in)

    $config = array(
        'serverTitle'       => $serverDomain,
        'serverVersion'     => $serverVersion,

        'pathServer'        => $pathServer,
        'pathLogs'          => $pathServer.'/logs',

        'fileUserCache'     => $pathServer.'/usercache.json',

        'pathAdvancements'  => $pathServer.'/world/advancements',

        'pathWorld'         => $pathServer.'/world',
        'pathWorldNether'   => $pathServer.'/world_nether',
        'pathWorldTheEnd'   => $pathServer.'/world_the_end',

        'serverDescription' => $serverDomain.' is an open survival MC Server.'  //Here you can change the text of the Infobox
    );
?>