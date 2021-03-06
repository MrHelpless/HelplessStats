<?php
    include 'config.php';

    $uuid=htmlspecialchars($_GET['uuid']);

    function getJsonToArray($file) {                                    //Gets a PHP Array ot of a json file
        if(file_exists($file)){
            return json_decode(file_get_contents($file));
        } else {
            return false;
        }
    }
    $userLastVisitors = getJsonToArray($config['fileUserCache']);

    foreach ($userLastVisitors as &$user) {                             //Serching Playername by UUID
        if ($user->uuid == $uuid) {
            $username = $user->name;
        }
    }

    $userAvatar = 'https://crafatar.com/avatar/' . $uuid;               //Avatar Head Picture by crafatar.com
    $userBody = 'https://crafatar.com/renders/body/' . $uuid;           //Avatar Body Picture by crafatar.com
?>


<html lang=en>

    <head>
        <title><?php echo $config['serverTitle'] . ' > ' . $username ?></title>     <!--ServerTitle from Config-->
        <link type="text/css" rel="stylesheet" href="style.css">
    </head>

    <body>
        <div class="wrapper">

            <div class="navbar">
                <a class="nLogo" href="./"><?php echo $config['serverTitle'] ?></a> <!--ServerTitle from Config-->
                <a class="nLink" href="./helplessplugin/" target="_blank">HelplessPlugin</a>
            </div>

            <div class="content">
                <div class="box">
                    <h1><?php echo $username ?></h1>                                <!--Username-->
                    <p>
                        <?php                                                       //Link to namemc.com
                            echo '<a target="_blank" href="https://de.namemc.com/profile/' . $uuid . '">NameMC</a><br>';
                        ?>
                    </p>
                    <img src="<?php echo $userBody; ?>"/>
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