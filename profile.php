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
    
    function isValueInFile($value, $file) {
        if( strpos(file_get_contents($file), $value) !== false)
            return true;
        return false;
    }

    $userLastVisitors = getJsonToArray($config['fileUserCache']);

    foreach ($userLastVisitors as &$user) {                             //Serching Playername by UUID
        if ($user->uuid == $uuid) {
            $username = $user->name;
        }
    }

    $userAvatar = 'https://crafatar.com/avatar/' . $uuid;               //Avatar Head Picture by crafatar.com
    $userBody = 'https://crafatar.com/renders/body/' . $uuid;           //Avatar Body Picture by crafatar.com


    $stringFoundItems = "";

    if(isValueInFile("minecraft:story/mine_stone", $config['pathAdvancements'] . '/' . $uuid . '.json'))
        $stringFoundItems .= ' <span style="color: #6d6d6d; font-weight: bolder;">Stone</span>';

    if(isValueInFile("minecraft:story/mine_diamond", $config['pathAdvancements'] . '/' . $uuid . '.json'))
        $stringFoundItems .= ', <span style="color: #41b8df; font-weight: bolder;">Diamonds</span>';

    if(isValueInFile("minecraft:nether/obtain_ancient_debris", $config['pathAdvancements'] . '/' . $uuid . '.json'))
        $stringFoundItems .= ', <span style="color: #6a0606; font-weight: bolder;">Ancient_Debri</span>';

    if($stringFoundItems == "")
        $stringFoundItems = ' Nothing';


    $str = file_get_contents('/home/mc/paper/world/stats/' . $uuid . '.json');
    $pattern = '/"minecraft:walk_one_cm":([0-9]*),/m';
    preg_match($pattern, $str, $arr);
    $walkDistance = round($arr[1] / 100);

    $pattern = '/"minecraft:sprint_one_cm":([0-9]*),/m';
    preg_match($pattern, $str, $arr);
    $sprintDistance = round($arr[1] / 100);

    $pattern = '/"minecraft:swim_one_cm":([0-9]*),/m';
    preg_match($pattern, $str, $arr);
    $swimDistance = round($arr[1] / 100);

    $pattern = '/"minecraft:fly_one_cm":([0-9]*),/m';
    preg_match($pattern, $str, $arr);
    $flyDistance = round($arr[1] / 100);

    $allDistance = $walkDistance + $sprintDistance + $swimDistance + $flyDistance;
?>



<!DOCTYPE html>



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
                    <h1><?php echo $username ?></h1>                                <!--Username of the Player-->
                    <p>
                        <?php                                                       //Link to namemc.com
                            echo '<a target="_blank" href="https://de.namemc.com/profile/' . $uuid . '">NameMC</a><br>';
                        ?>
                    </p>
                    <img src="<?php echo $userBody; ?>"/>
                    <?php
                        echo '<p>Officially found:' . $stringFoundItems . '</p>';
                        echo '<p>Walked: ' . $walkDistance . 'm | Sprinted: ' . $sprintDistance . '<br>Swept: ' . $swimDistance . 'm | Flown: ' . $flyDistance . 'm<br>In total: ' . $allDistance . 'm / ' . round($allDistance / 1000) . 'km</p>';
                    ?>
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