<?php  
 /**
 *  Deals manager email config.
 * 
 * @author:   AnkkSoft.com
 * @Copyright: AnkkSoft 2019
 * @Website:   https://www.ankksoft.com
 * @CodeCanyon User:  https://codecanyon.net/user/codeloop 
 *
 * This is email configuration file.
 *
 * Use it to configure email transports of Deals Manager.
 *
 * transport => The name of a supported transport; valid options are as follows:
 *  Mail - Send using PHP mail function
 *  Smtp - Send using SMTP
 *  Debug - Do not send the email, just return the result
 */
                                                     
						
class EmailConfig
{

    public $default = array(
        'transport' => 'Mail',
        'from' => 'you@localhost',
    );
    public $smtp = array(
        'transport' => 'Smtp',
        'from' => array('site@localhost' => 'My Site'),
        'host' => '',
        'port' => '45',
        'timeout' => 30,
        'username' => '',
        'password' => '',
        'client' => null,
        'log' => false,
    );
    

}

/* End of file email.php */
/* Location: ./app/Config/email.php */
							