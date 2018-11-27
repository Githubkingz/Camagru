<?php
  require_once 'header.php';

  if (!$loggedin) die("</div></body></html>");

  echo "<div class='main'>";

  if (isset($_GET['view']))
  {
    $view = sanitizeString($_GET['view']);
    
    if ($view == $user) $name = "Your";
    else                $name = "$view's";
    
    echo "<h3>$name Profile</h3>";
    //showProfile($user);
    showProfile($view);
    echo "<a data-role='button' data-transition='slide'
          href='messages.php?view=$view'>View $name messages</a>";
    die("</div></body></html>");
  }

  if (isset($_GET['add']))
  {
    $add = sanitizeString($_GET['add']);

    $result = queryMysql("SELECT * FROM friends WHERE user='$add' AND friend='$user'");
    $result->setFetchMode(PDO::FETCH_ASSOC);
    if (!$result->fetch())
      $conn->exec("INSERT INTO friends VALUES ('$add', '$user')");
  }
  elseif (isset($_GET['remove']))
  {
    $remove = sanitizeString($_GET['remove']);
    $conn->exec("DELETE FROM friends WHERE user='$remove' AND friend='$user'");
  }

  $result = queryMysql("SELECT user FROM members ORDER BY user");
  $result->setFetchMode(PDO::FETCH_ASSOC);
  $num = array();
  $num    = $result->rowCount();
  showProfile($user);
  echo "<h3>Other Members</h3><ul>";

  for ($j = 0 ; $j < $num ; ++$j)
  {
    $row = $result->fetch(PDO::FETCH_ASSOC);
    if ($row['user'] == $user) continue;
    
    echo "<li><a data-transition='slide' href='members.php?view=" .
      $row['user'] . "'>" . $row['user'] . "</a>";
    $follow = "befriend";

    $result1 = queryMysql("SELECT * FROM friends WHERE
      user='" . $row['user'] . "' AND friend='$user'");
    $result1->setFetchMode(PDO::FETCH_ASSOC);
    $t1 = $result1->rowCount();
    $result1 = queryMysql("SELECT * FROM friends WHERE
      user='$user' AND friend='" . $row['user'] . "'");
    $result1->setFetchMode(PDO::FETCH_ASSOC);
    $t2 = $result1->rowCount();
    // $tol = array();
    // array_push($tol, $t1, $t2);
    if (($t1 + $t2) > 1){ 
      echo " &harr; is a mutual friend";
      //break;
    }
    elseif ($t1){
      echo " &larr; you are following";
     // break;
    }
    elseif ($t2){
      echo " &rarr; is following you";
      $follow = "recip";
    }
    
    if (!$t1) echo " [<a data-transition='slide'
      href='members.php?add=" . $row['user'] . "'>$follow</a>]";
    else      echo " [<a data-transition='slide'
      href='members.php?remove=" . $row['user'] . "'>unfriend</a>]";
    //break;
  }
?>
    </ul></div>
  </body>
</html>
