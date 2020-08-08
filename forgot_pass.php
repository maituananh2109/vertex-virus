<?php
    include("libs/bootstrap.php");
	include("libs/mailer/class.smtp.php");
	include("libs/mailer/class.phpmailer.php");
	use PHPMailer\PHPMailer\PHPMailer;
	use PHPMailer\PHPMailer\Exception;
	require "libs/mailer/vendor/autoload.php";
    $axtp = new XTemplate("view/forgot_pass.html");
    function getPass($len=32){
        return substr(md5(openssl_random_pseudo_bytes(20)), -$len);
    }
    $new_pass = getPass(10);
    $do_save = 1;
    if($_POST){
        $email = $_POST['email'];
        $sql = "SELECT email FROM accounts";
        $rs  = $db -> fetchAll($sql);
        $pass = sha1($new_pass);
        $pass = "{$pass}{$salt}";
        $mail = new PHPMailer(true);
	        $title = ' Get new password your Vertex Virus account '; // tiêu đề 
	        $content = 'We received a request to reset your password for your Vertex Virus account. We are here to help! Your new password: '.$new_pass.' <a href="http://localhost:89/eprojects/sign-in">Sign In</a>'; // nội dung mail
	        $nTo = 'User Vertex Virus'; // tên người gửi
	        $mTo = $email; // mail người gửi
        if($do_save == 1){
            $arrData['password'] = $pass;
            $where = "email = '$email'";
            if($db -> update('accounts',$arrData,$where)){
                if($send -> sendMail($title, $content, $nTo, $mTo, $diachicc = '') == 1){
                    $axtp -> parse('FP.CHECKEMAIL');
                }
            }
        }
    }
    $axtp -> assign('baseUrl',$baseUrl);
    $axtp -> parse('FP');
    $axtp -> out('FP');