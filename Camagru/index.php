<?php 
  session_start();
  require_once 'header.php';

  echo "<div class='center'>Welcome to InstaGuru page,";

  if ($loggedin)
    echo " $user, you are logged-in!!!";
  else
    echo " please sign-up or login!!!";

  echo <<<_END
      </div><br>
    </div>
    <div data-role="footer">
      <h4>Page Link to <i><a href='http://newbie0007.com'
      target='_blank'>Click here to view my GitHub Profile</a></i></h4>
    </div>
  </body>
</html>
_END;
?>
