<?php
// Import PHPMailer classes into the global namespace
// These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require '../PHPMailer/src/Exception.php';
require '../PHPMailer/src/PHPMailer.php';
require '../PHPMailer/src/SMTP.php';
require '../connection.php';

if (isset($_POST['reset'])) {
  // require '../connection.php';

  $emailTo = $_POST['email'];

  $query = mysqli_query($conn, "SELECT * FROM customer WHERE Cust_Email = '" . $emailTo . "'");

  $row = mysqli_fetch_array($query);

  if ($row) {
    $token = uniqid(true);
    $query = mysqli_query($conn, "UPDATE customer SET Token='" . $token . "' WHERE Cust_Email = '" . $emailTo . "'");

    $mail = new PHPMailer(true);

    try {
        $mail->isSMTP();
        $mail->Host       = 'smtp.gmail.com';
        $mail->SMTPAuth   = true;
        $mail->Username   = 'thefourpawss@gmail.com';
        $mail->Password   = '@Thefourpaws';
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port       = 587;

        $mail->setFrom('thefourpawss@gmail.com', 'Rumah Kucing');
        $mail->addAddress("$emailTo");
        $mail->addReplyTo('reply@admin.tfp.com', 'ADMIN');

        $url = "http://" . $_SERVER["HTTP_HOST"] . "/test/include/resetPassword.php?code=$token";
        $mail->isHTML(true);
        $mail->Subject = 'Reset your password';
        // $mail->Body    = '<h1 class="text-center">Hi '. $row["Cust_Fname"] . ',</h1>
        //                     <p>We received a request to reset the password for your account. You can update your password by clicking the button below.</p>
        //                     <a class="btn btn-primary btn-lg" href= '.$url.'>Reset Password</a>';

        $mail->Body = '<!DOCTYPE html>
                      <html>
                          <head>
                              <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
                              <meta http-equiv="X-UA-Compatible" content="IE=edge" />
                              <meta name="viewport" content="width=device-width, initial-scale=1.0">
                              <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.1/css/all.css">

                              <title>Email Template</title>

                              <style type="text/css">
                                  body {
                                      margin: 0;
                                      background-color: #cccccc;
                                  }
                                  table {
                                      border-spacing: 0;
                                  }
                                  td {
                                      padding: 0;
                                  }
                                  img {
                                      border: 0;
                                  }
                                  .wrapper {
                                      width: 100%;
                                      table-layout: fixed;
                                      background-color: #cccccc;
                                      padding-bottom: 40px;
                                  }
                                  .main {
                                      background-color: #ffffff;
                                      margin: 0 auto;
                                      width: 100%;
                                      max-width: 600px;
                                      border-spacing: 0;
                                      font-family: sans-serif;
                                      color: #4a4a4a;
                                  }
                                  .main2 {
                                      background-color: black;
                                      margin: 0 auto;
                                      width: 100%;
                                      max-width: 600px;
                                      border-spacing: 0;
                                      font-family: sans-serif;
                                      color: #4a4a4a;
                                  }
                                  a {
                                      text-decoration: none;
                                      color: #4980d2;
                                  }

                                  @media screen and (max-width: 600px) {
                                      .content img {
                                          width: 300px!important;
                                          max-width: 300px!important;
                                      }
                                      .padding {
                                          padding-right: 0!important;
                                          padding-left: 0!important;
                                      }
                                  }
                              </style>
                          </head>
                          <body>
                              <center class="wrapper">
                                  <table class="main" width="100%">

                              <!-- TITLE, TEXT & BUTTON -->
                                      <tr>
                                          <td style="padding-bottom: 40px;">
                                              <table width="100%">
                                                  <tr>
                                                      <td style="text-align: center; padding: 15px;">
                                                          <p style="font-size: 20px; font-weight: bold;">Hai '. $row["Cust_Fname"] . '!</p>
                                                          <p style="font-size: 15px; line-height: 23px; padding: 5px 0 15px;">We received a request to reset the password for your account. You can update your password by clicking the button below.</p>
                                                          <a href= '.$url.' style="background-color: #4980d2; color: #ffffff;text-decoration: none;padding: 12px 20px;border-radius: 5px;font-weight: bold;">Reset Password</a>
                                                      </td>
                                                  </tr>
                                              </table>
                                          </td>
                                      </tr>

                              <!-- FOOTER SECTION -->
                                      <tr>
                                          <td style="background-color: #efefef;">
                                              <table width="100%">
                                                  <tr>
                                                      <td style="padding: 30px 10px; text-align: center;">
                                                          <!-- <a href="#"><img src="https://uploads-ssl.webflow.com/5fd7aee8b2a3733ee6e78885/5fd7afaa3928352b0ce2df58_logo.JPG" alt="" width="160"></a> -->
                                                          <p>ADMIN</p>
                                                          <p>Universiti Teknikal Malaysia Melaka</p>
                                                          <p>Copyright © 2021 RK | Rumah Kucing. All Rights Reserved.</p>
                                                      </td>
                                                  </tr>

                                                  <tr>
                                                      <td height="10" style="background-color: #4980d2;"></td>
                                                  </tr>
                                              </table>
                                          </td>
                                      </tr>
                                  </table>
                              </center>
                          </body>
                      </html>
                      ';

        $mail->send();

        echo '<div class="alert alert-success text-center">If an account with that email exists, then you should receive a reset email shortly. Please check your email!</div>';
    }catch (Exception $e) {
        echo '<div class="alert alert-success text-center">Something went wrong please try again later!</div>';
    }
  } else {
    echo '<div class="alert alert-success text-center">This email does not exist</div>';
  }
}
?>

<!-- EMAIL DESIGN -->
<!-- <!DOCTYPE html>
              <html>
                  <head>
                      <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
                      <meta http-equiv="X-UA-Compatible" content="IE=edge" />
                      <meta name="viewport" content="width=device-width, initial-scale=1.0">
                      <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.1/css/all.css">

                      <title>Email Template</title>

                      <style type="text/css">
                          body {
                              margin: 0;
                              background-color: #cccccc;
                          }
                          table {
                              border-spacing: 0;
                          }
                          td {
                              padding: 0;
                          }
                          img {
                              border: 0;
                          }
                          .wrapper {
                              width: 100%;
                              table-layout: fixed;
                              background-color: #cccccc;
                              padding-bottom: 40px;
                          }
                          .main {
                              background-color: #ffffff;
                              margin: 0 auto;
                              width: 100%;
                              max-width: 600px;
                              border-spacing: 0;
                              font-family: sans-serif;
                              color: #4a4a4a;
                          }
                          .main2 {
                              background-color: black;
                              margin: 0 auto;
                              width: 100%;
                              max-width: 600px;
                              border-spacing: 0;
                              font-family: sans-serif;
                              color: #4a4a4a;
                          }
                          a {
                              text-decoration: none;
                              color: #4980d2;
                          }

                          @media screen and (max-width: 600px) {
                              .content img {
                                  width: 300px!important;
                                  max-width: 300px!important;
                              }
                              .padding {
                                  padding-right: 0!important;
                                  padding-left: 0!important;
                              }
                          }
                      </style>
                  </head>
                  <body>
                      <center class="wrapper">
                          <table class="main" width="100%">-->

                      <!-- SOCIAL MEDIA ICONS -->
                              <!-- <tr>
                                  <td>
                                      <table width="100%">
                                          <tr>
                                              <td style="background-color: #4980d2; padding: 8px 0 5px; text-align: center;">
                                                  <a href="https://www.instagram.com/jom_dakwah/"><img src="https://uploads-ssl.webflow.com/5fd7aee8b2a3733ee6e78885/5fd7b45fc7c624b13fa07011_fb.png" alt="" width="30"></a>
                                                  <a href="https://www.instagram.com/neelofa/"><img src="https://uploads-ssl.webflow.com/5fd7aee8b2a3733ee6e78885/5fd7b45fed95543dc87824ef_twitter.png" alt="" width="30"></a>
                                                  <a href="https://www.instagram.com/sooyaaa__/"><img src="https://uploads-ssl.webflow.com/5fd7aee8b2a3733ee6e78885/5fd7b45f9a378fb58c75068a_ig.png" alt="" width="30"></a>
                                                  <a href="https://www.instagram.com/cristiano/"><img src="https://uploads-ssl.webflow.com/5fd7aee8b2a3733ee6e78885/5fd7b45f3928353a12e2f55d_yt.png" alt="" width="30"></a>
                                              </td>
                                          </tr>
                                      </table>
                                  </td>
                              </tr> -->

                      <!-- LOGO SECTION -->
                              <!-- <tr>
                                  <td>
                                      <table class="main2" width="100%" >
                                          <tr>
                                              <td style="text-align: center; padding: 10px; color: black;">
                                                  <a href="#"><img src="https://uploads-ssl.webflow.com/5fd7aee8b2a3733ee6e78885/5fd7afaa3928352b0ce2df58_logo.JPG" alt="Logo" width="250" title="Logo"></a>
                                              </td>
                                          </tr>
                                      </table>
                                  </td>
                              </tr> -->

                      <!-- GIF BANNER IMAGE -->
                              <!-- <tr>
                                  <td>
                                      <a href="#"><img src="https://uploads-ssl.webflow.com/5fd7aee8b2a3733ee6e78885/5fd7db8484ec5e4a01d3b03f_catmeme.gif" alt="Banner" width="600" style="max-width: 100%;"></a>
                                  </td>
                              </tr> -->

                      <!-- TITLE, TEXT & BUTTON -->
                              <!-- <tr>
                                  <td style="padding-bottom: 40px;">
                                      <table width="100%">
                                          <tr>
                                              <td style="text-align: center; padding: 15px;">
                                                  <p style="font-size: 20px; font-weight: bold;">Hai '. $row["Cust_Fname"] . '!</p>
                                                  <p style="font-size: 15px; line-height: 23px; padding: 5px 0 15px;">We received a request to reset the password for your account. You can update your password by clicking the button below.</p>
                                                  <a href= '.$url.' style="background-color: #4980d2; color: #ffffff;text-decoration: none;padding: 12px 20px;border-radius: 5px;font-weight: bold;">Reset Password</a>
                                              </td>
                                          </tr>
                                      </table>
                                  </td>
                              </tr> -->

                      <!-- FOOTER SECTION -->
                              <!-- <tr>
                                  <td style="background-color: #efefef;">
                                      <table width="100%">
                                          <tr>
                                              <td style="padding: 30px 10px; text-align: center;"> -->
                                                  <!-- <a href="#"><img src="https://uploads-ssl.webflow.com/5fd7aee8b2a3733ee6e78885/5fd7afaa3928352b0ce2df58_logo.JPG" alt="" width="160"></a> -->
                                                  <!-- <p>ADMIN</p>
                                                  <p>Universiti Teknikal Malaysia Melaka</p>
                                                  <p>Copyright © 2020 TFP | The Four Paws. All Rights Reserved.</p>
                                                  <p><a href="#">UNSUBSCRIBE</a></p>
                                              </td>
                                          </tr>

                                          <tr>
                                              <td height="10" style="background-color: #4980d2;"></td>
                                          </tr>

                                      </table>
                                  </td>
                              </tr>
                          </table>
                      </center>

                  </body>
              </html>  -->
