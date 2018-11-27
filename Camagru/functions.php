<?php
  $dbhost  = 'localhost';
  $dbname  = 'datat';
  $dbuser  = 'root';
  $dbpass  = 'SamsungS5';

  $conn = new PDO("mysql:host=$dbhost;$dbname", $dbuser, $dbpass);
  try{
    $conn = new PDO("mysql:host=$dbhost;$dbname", $dbuser, $dbpass);
    //set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $sql = "CREATE DATABASE IF NOT EXISTS $dbname";
    //use exec() because no results are returned
    $conn->exec($sql);
    $sql = "use $dbname";
    $conn->exec($sql);
    // $conn->setAttribute(\PDO::ATTR_AUTOCOMMIT,FALSE);
    // $conn->beginTransaction();
    
    $sql = "CREATE TABLE IF NOT EXISTS members (user VARCHAR(16),pass VARCHAR(16),
    INDEX(user(6)))";
    $conn->exec($sql);

    $sql = "CREATE TABLE IF NOT EXISTS messages (id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
              auth VARCHAR(16), recip VARCHAR(16),pm CHAR(1),time INT UNSIGNED,message VARCHAR(4096),
              INDEX(auth(6)),INDEX(recip(6)))";
    $conn->exec($sql);

    $sql = "CREATE TABLE IF NOT EXISTS friends (user VARCHAR(16),friend VARCHAR(16),
    INDEX(user(6)), INDEX(friend(6)))";
    $conn->exec($sql);

    $sql = "CREATE TABLE IF NOT EXISTS profiles (user VARCHAR(16),text VARCHAR(4096),
    INDEX(user(6)))";
    $conn->exec($sql);
    // $conn->rollBack();
      echo "Connetion successful and Database created!<br>";
  }
  catch(PDOEXCEPTION $e)
  {
    echo "Connection fialed : ".$sql."<br>".$e->getMessage();
  }
  
  function queryMysql($query)
  {
    global $conn;
    $res = $conn->query($query);
    //$res = $conn->exec($query);
    if ($res !== FALSE){ echo "";}
    else{echo "Failure";}
    //if ($result !== FALSE) die("Fatal Error");
    return $res;
  }

  function destroySession()
  {
    $_SESSION=array();

    if (session_id() != "" || isset($_COOKIE[session_name()]))
      setcookie(session_name(), '', time()-2592000, '/');

    session_destroy();
  }

  function sanitizeString($var)
  {
    global $conn;
    $var = strip_tags($var);
    $var = htmlentities($var);
    if (get_magic_quotes_gpc())
      $var = stripslashes($var);
    return ($var);
  }

  function showProfile($user)
  {
    global $conn;
    if (file_exists("$user.jpg"))
        echo "<img src='$user.jpg' align='left' />";

    $result = queryMysql("SELECT * FROM profiles WHERE user='$user'");
    $result->setFetchMode(PDO::FETCH_ASSOC);

    if ($result->rowCount())
    {
        $row = $result->fetch(PDO::FETCH_ASSOC);
        print("My name is $user <br></br>");
        echo stripslashes($row['text'])."<br clear=left /><br />";
    }
    else echo "No text input data stored!!\n\n";
  }
  //$conn = null;
?>
