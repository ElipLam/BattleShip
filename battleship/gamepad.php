<?php

require_once 'includes/inc.global.php';

$meta['title'] = 'Available gamepads';
$meta['head_data'] = '<link rel="stylesheet" type="text/css" media="screen" href="css/pad.css" />';
$meta['foot_data'] = '<script type="text/javascript" src="scripts/invite.js"></script>
                      <script src="socket.io/dist/socket.io.js" type="text/javascript" ></script>
					  <script src="scripts/game_pad.js" type="text/javascript" ></script>
					  <script src="socket.io/client_gamepab.js" type="text/javascript" ></script>
                    ';
$hints='';
$contents = '
            <form action="invite.php" method="post">
            <table>
                <tr>
                    <td><img src="images/gamepad.png" alt=""></td>
                    <td><div class="button102" type="button" name="gamepad1" id="gamepad1" value=""></div></td>
                    <td><input class="nav102" type="submit" name="submit" value="Gamepad 1"></td>
                </tr>
                <tr> 
                    <td><img src="images/gamepad.png"  alt=""></td>
                    <td><div class="button102" type="button" name="gamepad2" id="gamepad2" value=""></div></td>
                    <td><input class="nav102" type="submit" name="submit" value="Gamepad 2"></td>
                </tr>
            </table>
            </form>
            ';
echo get_header($meta);
echo get_item($contents, $hints, $meta['title']);
call($GLOBALS);
echo get_footer($meta);
?>