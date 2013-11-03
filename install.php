<?php
ob_start();
error_reporting(0);
?>
    <!DOCTYPE html>
<html>
    <head>
        <title>Install</title>
        <style>
            @import url('css/reset.css');

            @import url('css/main.css');
        </style>
    </head>
    <br />

    <div style="width: 70%;background: white;margin-left:auto;margin-right:auto;padding: 25px;border-radius:5px;">
    <?php
    $message = '';
    if(isset($_POST['install'])){
        if(empty($_POST['db_host']) || empty($_POST['db_name']) || empty($_POST['db_user'])){
            $message = '<center><font color="red"><b>You did not fill the necesary spaces</b></font></center>';
        } else {
            $db_host = htmlentities($_POST['db_host']);
            $db_name = htmlentities($_POST['db_name']);
            $db_user = htmlentities($_POST['db_user']);
            $db_pass = htmlentities($_POST['db_pass']);
            $status_connection = 1;
            $connection = mysql_connect("$db_host", "$db_user", "$db_pass") or $status_connection = 2;
            mysql_select_db(''.$db_name.'', $connection) or $status_connection = 2;
            if($status_connection == 2){
                echo  '<center><font color="red"><b>Connection Failed, please try again</b></font></center>';
            } else {
                $text = <<<PHP
<?php

define('debug', false);
define('f_inc', 'inc/');
define('provider', 'PaidMine');

class Config {

  public static function getMysqlInfo() {
    return(array(
        'host' => '$db_host',
        'user' => '$db_user',
        'pass' => '$db_pass',
        'db' => '$db_name',

        'log_invalid_ipns' => true,

        'item_table' => 'items',
        'user_table' => 'users',
        'log_pp_raw_table' => 'log_pp_raw'
    ));
  }

  public static function postConfig(){
    raintpl::\$tpl_dir = f_inc . 'tpl/'; // template directory
    raintpl::\$cache_dir = f_inc . 'cache/'; // cache directory
    raintpl::configure('path_replace', false);
  }

}
PHP;
                $file = 'config.php';
                $command = fopen($file, 'w');
                fwrite($command, $text);
                fclose($command);

                $sql = readfile('install.sql');
                if($sql){
                    mysql_query($sql);
                    header('Location: install.php?success');
                }else{
                    die('The sql file could not be read.');
                }
            }
        }
    }
    if(isset($_GET['success']) && empty($_GET['success'])) {
        echo '<center>
		<font color=\'green\'>The mysql query and the config has successfully updated!</font>
		<br />Please delete this file now(install.php), for security reasons!<br /><br />
		</center>
	';
    }

    ?>

    <center>
        <?php echo $message; ?>
        <form name="install" method="post" action="">
            <h3>Database Connection</h3>
            <p>
            <table>
                <tr>
                    <td><label>Database Host</label></td>
                    <td><input  name="db_host" type="text" size="30" value="localhost" /></td>
                </tr>
                <tr>
                    <td><label>Database Name</label></td>
                    <td><input  name="db_name" type="text" size="30" value="<?php echo $_POST['db_name']; ?>" /></td>
                </tr>
                <tr>
                    <td><label>Database User</label></td>
                    <td><input  name="db_user" type="text" size="30" value="<?php echo $_POST['db_user']; ?>" /></td>
                </tr>
                <tr>
                    <td><label>Database Password</label></td>
                    <td><input  name="db_pass" type="text" size="30" value="<?php echo $_POST['db_pass']; ?>" /></td>
                </tr>
                <tr>
                    <td><br />
                        <input  type="submit" name="install" value="Install" />
                    </td>
                </tr>
            </table>
            </p>
        </form>
    </center>
    </div>
<?php
ob_flush();
?>