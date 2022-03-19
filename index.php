<?php
    include 'config.php';
    include 'mcsrvstatus.php';
    
    function getJsonToArray($file) {
        if(file_exists($file)){
            return json_decode(file_get_contents($file));
        } else {
            return false;
        }
    }

    function getAllFileTitelsInDir($dir) {
        if(is_dir($dir)) {
            return array_diff(scandir($dir), array('..', '.'));
        } else {
            return false;
        }
    }

    function getDirectorySize($path){
        $bytestotal = 0;
        $path = realpath($path);
        if($path!==false && $path!='' && file_exists($path)){
            foreach(new RecursiveIteratorIterator(new RecursiveDirectoryIterator($path, FilesystemIterator::SKIP_DOTS)) as $object){
                $bytestotal += $object->getSize();
            }
        }
        return $bytestotal;
    }

    $userLastVisitors = getJsonToArray($config['fileUserCache']);
    $userFullList = getAllFileTitelsInDir($config['pathAdvancements']);
?>

<!DOCTYPE html>

<html lang=en>

    <head>
        <title><?php echo $config['serverTitle']; ?></title>
        <link type="text/css" rel="stylesheet" href="style.css">
    </head>

    <body>
        <div class="wrapper">
            <div class="navbar">
                <a class="nLogo" href="./"><?php echo $config['serverTitle']; ?></a>
                <a class="nLink" href="./helplessplugin/" target="_blank">HelplessPlugin</a>    <!--Additional Link for my Plugin Source-Code (if not wanted pleas delete this complete row or comment it)-->
            </div>
            <div class="content">
                <div class="box">
                    <h1>Welcome to <?php echo $config['serverTitle']; ?></h1>
                    <p>
                        <?php echo $config['serverDescription']; ?>
                    </p>
                </div>
                <div class="box">
                    <h1>Server Status</h1>
                    <p>Status: <?php if ($serverStatus->online == true) { echo '<span style="color: #00ff00;">Online</span>'; } else { echo '<span style="color: #ff0000;">Offline</span>'; }; ?></p>
                    <p>Player: <?php echo $serverStatus->onlinePlayer . ' / ' . $serverStatus->maxPlayer; ?>
                </div>
                <div class="box">
                    <h1>Last active Users</h1>
                    <?php
                        $x = 0;
                        foreach ($userLastVisitors as &$user) {
                            echo '<a href="./profile.php?uuid=' . $user->uuid . '"><img src="https://crafatar.com/avatars/' . $user->uuid . '" alt="' . $user->name . '"></a>';
                            
                            if($x++ >= 11) {
                                break;
                            }
                        }
                    ?>
                </div>
                <div class="box">
                    <?php
                        echo '<h1>All Users (' . count($userFullList) . ')</h1>';
                        foreach ($userFullList as &$user) {
                            echo "<a href=\"./profile.php?uuid=" . explode(".", $user)[0] . "\"><img style=\"width: 96px; height: 96px;\" src=\"https://crafatar.com/avatars/" . $user . "\" alt=\"avatar\"></a>";
                        }
                    ?>
                </div>
                <div class="box">
                    <h1>World Size</h1>
                    <table style="width: 100%;">
                        <tbody>
                            <tr>
                                <th>World Name</th>
                                <th>World Size</th>
                            </tr>
                            <tr>
                                <td>world</th>
                                <td><?php echo round(getDirectorySize($config['pathWorld']) / 1000000000, 2) . "GB"; ?></th>
                            </tr>
                            <tr>
                                <td>world_nether</th>
                                <td><?php echo round(getDirectorySize($config['pathWorldNether']) / 1000000000, 2) . "GB"; ?></th>
                            </tr>
                            <tr>
                                <td>world_the_end</th>
                                <td><?php echo round(getDirectorySize($config['pathWorldTheEnd']) / 1000000000, 2) . "GB"; ?></th>
                            </tr>
                        </tbody>
                    </table>
                    <p>
                        <?php echo "total: " . round((getDirectorySize($config['pathWorld']) + getDirectorySize($config['pathWorldNether']) + getDirectorySize($config['pathWorldTheEnd'])) / 1000000000, 2) . "GB "; ?>
                    </p>
                </div>
            </div>
            <div class="footer">
                <p>by <a href="https://www.mrhelpless.xyz">MrHelpless</a></p>
            </div>
        </div>

    </body>

</html>

<script>    //Only for mobile View!!!
    // First we get the viewport height and we multiple it by 1% to get a value for a vh unit
    let vh = window.innerHeight * 0.01;
    // Then we set the value in the --vh custom property to the root of the document
    document.documentElement.style.setProperty('--vh', `${vh}px`);
</script>