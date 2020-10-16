<?php
function confirmMail($toAddr, $toUsername, $token, $ip) {
      $subject = "[CAMAGRU] - Email verification";
      $headers  = 'MIME-Version: 1.0' . "\r\n";
      $headers .= 'Content-type: text/html; charset=UTF-8' . "\r\n";
      $headers .= 'From: <registration@camagru.co.za>' . "\r\n";
      $message = '
      <html>
        <head>
          <title>' . $subject . '</title>
        </head>
        <body>
          Hello ' . htmlspecialchars($toUsername) . ' </br>,
          to complete your signing up please click on the following link </br>
          <a href="http://'.$ip .'/verify.php?token=' . $token . '">Verify email</a>
        </body>
      </html>
      ';
      mail($toAddr, $subject, $message, $headers);
      echo '<script>alert("Registered Successfully. Please check your email for a verification link")</script>';
}

?>