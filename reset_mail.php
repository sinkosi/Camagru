<?php
echo ('Eish');
require_once('./config/createConnection.php');
if (isset($_POST['email']))
{
    $email = $_POST['email'];
    if (!filter_var($email, FILTER_VALIDATE_EMAIL))
    {
        header("Location: ./forgot.php?invalid=1");
    }
    else if (filter_var($email, FILTER_VALIDATE_EMAIL))
    {
        try
        {
            // $conn = new PDO($db_dsn, $db_username, $db_password);
            // $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $stmt = $conn->prepare("SELECT * FROM user WHERE email = :email");
            $stmt->execute(array(':email' => $email));
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            if (count($result))
            {
                foreach($result as $row)
                {
                    if ($row['verified'] == 1)
                    {
                        $vc = $row['vc'];
                        $subject = "Camagru: Password Reset Link";
                        $msg = "To reset your account password\nClick the link below\n\nhttp://localhost:8080/camagru/reset_mail_validate.php?reset=1&vc=".$vc."&email=".$email;
                        $headers = 'From: noreply@camagru.com';
                        mail($email, $subject, $msg, $headers);
                        header("Location: ./forgot.php?reset=1");
                    }
                    else
                    {
                        header("Location: ./forgot.php?verify=-1");
                        exit();
                    }
                }
            }
            else
            {
                header("Location: ./forgot.php?email_not_found");
                exit();
            }
        }
        catch(PDOException $e)
        {
            header("Location: ./forgot.php?con=error");
            exit();
        }
    }
}
else
{
    header("Location: ./forgot.php?email");
    exit();
}
?>

