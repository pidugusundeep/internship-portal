<?php
session_Start();
session_unset();
session_destroy();
header( "refresh:2; url=index.php" );
?>
<html>
    <body>
      <img src="images/Preloader_3.gif" alt="loading" height="200" width="200" style="padding-top:15%; padding-left:45%" align="center" />
    </body>
 </html>