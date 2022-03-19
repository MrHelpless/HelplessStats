<?php
    function getServerCpuUsage() {
        $load = sys_getloadavg();
        $load = $load[0]*100;

        return $load;
    }

    function getServerMemUsage() {
        $free = shell_exec('free');
        $free = (string)trim($free);
        $freeArr = explode("\n", $free);
        $mem = explode(" ", $freeArr[1]);
        $mem = array_filter($mem);
        $mem = array_merge($mem);

        $memUsageInPerc = round($mem[2]/$mem[1]*100, 2);
        $memUsageInGiga = round($mem[2]/1000000, 2) . 'GB/' . round($mem[1]/1000000, 2) . 'GB';

        //[<1GB/4GB>, <25%>]<meta http-equiv="refresh" content="5">
        return [$memUsageInGiga, $memUsageInPerc];
    }
?>



<!DOCTYPE html>



<html lang="en">

    <head>

        <meta http-equiv="refresh" content="5">

        <style>
            * {
                font-family: sans-serif;
                color: #fff;
                text-align: center;
                overflow: hidden;
            }

            html, body {
                background: #443177;
            }

            .wrapper {
                position: absolute;
                top: 50%;
                left: 50%;
                transform: translate(-50%, -50%);
            }


            .circle-wrap {
                float: left;
                margin: 32px;
                width: 150px;
                height: 150px;
                background: #6d6d6d;
                border-radius: 50%;
                box-shadow: 0px 0px 16px #000;
            }

            .circle-wrap .circle .mask,
            .circle-wrap .circle .fill {
                width: 150px;
                height: 150px;
                position: absolute;
                border-radius: 50%;
            }
            .mask .fill {
                clip: rect(0px, 75px, 150px, 0px);
                background-color: #61508f;
            }

            .circle-wrap .circle .mask {
                clip: rect(0px, 150px, 150px, 75px);
            }

            .circle-wrap .inside-circle {
                width: 122px;
                height: 122px;
                border-radius: 50%;
                background: #ffffff;
                line-height: 120px;
                text-align: center;
                margin-top: 14px;
                margin-left: 14px;
                position: absolute;
                z-index: 100;
            }

            .circle-wrap .inside-circle h2 {
                margin: 0;
                padding: 0;
                color: #61508f;
                font-weight: 700;
                font-size: 32px;
                line-height: 90px;
            }
            .circle-wrap .inside-circle p {
                margin: 0;
                padding: 0;
                color: #61508f;
                font-weight: 700;
                font-size: 16px;
                line-height: 20px;
            }



            #cpu .circle .mask.full,
            #cpu .circle .fill {
                animation: fillcpu ease-in-out 1s;
                transform: rotate(<?php echo (360/100) * getServerCpuUsage() / 2 ?>deg);
            }
            #mem .circle .mask.full,
            #mem .circle .fill {
                animation: fillmem ease-in-out 1s;
                transform: rotate(<?php echo (360/100) * getServerMemUsage()[1] / 2 ?>deg);
            }
            


            @keyframes fillcpu{
                0% {
                    transform: rotate(0deg);
                }
                100% {
                    transform: rotate(<?php echo (360/100) * getServerCpuUsage() / 2 ?>deg);
                }
            }
            @keyframes fillmem{
                0% {
                    transform: rotate(0deg);
                }
                100% {
                    transform: rotate(<?php echo (360/100) * getServerMemUsage()[1] / 2 ?>deg);
                }
            }
        </style>

    </head>

    <body>

        <?php
            echo 'CPU: ' . getServerCpuUsage() . '% / Mem: ' . getServerMemUsage()[1] . '% (' . getServerMemUsage()[0] . ')';
        ?>

        <div class="wrapper">
            <div id="cpu" class="circle-wrap">
                <div class="circle">
                    <div class="mask full">
                        <div class="fill"></div>
                    </div>
                    <div class="mask half">
                        <div class="fill"></div>
                    </div>
                    <div class="inside-circle">
                        <h2>CPU:</h2>
                        <p><?php echo getServerCpuUsage() ?>%</p>
                    </div>
                </div>
            </div>
            <div id="mem" class="circle-wrap">
                <div class="circle">
                    <div class="mask full">
                        <div class="fill"></div>
                    </div>
                    <div class="mask half">
                        <div class="fill"></div>
                    </div>
                    <div class="inside-circle">
                        <h2>Mem:</h2>
                        <p><?php echo getServerMemUsage()[1] ?>%</p>
                    </div>
                </div>
            </div>
        </div>

    </body>

</html>