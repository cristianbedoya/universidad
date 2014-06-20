    <?php
    if ( ! defined('BASEPATH')) exit('No direct script access allowed');
    $config['protocol'] = 'smtp';
    $config['smtp_host'] = 'ssl://smtp.googlemail.com';
    $config['smtp_port'] = 465;
    $config['smtp_user'] = 'cristianbedoya0208@gmail.com';
    $config['smtp_pass'] = 'superman92';
    $config['smtp_timeout'] = '7';
    $config['charset'] = 'iso-8859-1';
    $config['newline'] = "\r\n";
    $config['mailtype'] = 'text'; // or html
    $config['validation'] = TRUE; // bool whether to validate email or not
    ?>