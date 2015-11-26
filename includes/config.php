<?php
//config.php

define('DEBUG',TRUE); #we want to see all errors

date_default_timezone_set('America/Los_Angeles'); #sets default date/timezone for this website

include 'credentials.php'; //stores database login info
include 'common.php'; //stores all unsightly application functions, etc.
include 'MyAutoLoader.php'; //loads class that autoloads all classes in include folder

/* use the following path settings for placing all code in one application folder */ 
define('VIRTUAL_PATH', 'http://scottgreene.dreamhosters.com/retro/'); # Virtual (web) 'root' of application for images, JS & CSS files

define('PHYSICAL_PATH', '/home/scogre14/scottgreene.dreamhosters.com/retro/'); # Physical (PHP) 'root' of application for file & upload reference

define('INCLUDE_PATH', PHYSICAL_PATH . 'includes/'); # Path to PHP include files - INSIDE APPLICATION ROOT

ob_start();  #buffers our page to be prevent header errors. Call before INC files or ANY html!
header("Cache-Control: no-cache");header("Expires: -1");#Helps stop browser & proxy caching




// this defines the current file name
define('THIS_PAGE',basename($_SERVER['PHP_SELF']));

//echo THIS_PAGE;

//this allows us to add unique info to our pages
switch(THIS_PAGE)
{   
    case "index.php":
        $title = "Home Page";
        $pageID = "Welcome!";
        $headerPic = "images/burgerHead.jpg";
        break;
        
    case "daily.php":
        $title = "Daily Special!";
        $pageID = "Daily Special";
        $headerPic = "images/shakeHead.jpg";
        break;
        
    case "about.php":
        $title = "About Us";
        $pageID = "About Us";
        $headerPic = "images/friesHead.jpg";
        break;
        
    case "contact.php":
        $title = "Contact Us";
        $pageID = "Contact Us";
        $headerPic = "images/chickenHead.jpg";
        break;
        
    case "links.php":
        $title = "Links to Our Friends!";
        $pageID = "Links to Our Friends!";
        $headerPic = "images/hotdogHead.jpg";
        break;
        
     case "data1_list.php":
        $title = "My updated data page!";
        $pageID = "Tortoise Hats";
        $headerPic = "images/waitress.png";
        break;
        
    default:
        $title = THIS_PAGE;
        $pageID = "Retro Diner";
        $headerPic = "images/waitress.png";
        
}//end switch

//here are our navigation pages:
$nav1['index.php'] = 'Home';
$nav1['about.php'] = 'About Us';
$nav1['daily.php'] = 'Daily';
$nav1['data1_list.php'] = 'Tortoise Hats';
$nav1['links.php'] = 'Links';
$nav1['contact.php'] = 'Contact';

/*
    
				<li>
					<a class="active" href="index.html">Home</a>
				</li>
				<li>
					<a href="about.html">About</a>
				</li>
				<li>
					<a href="burger.html">Menu</a>
				</li>
				<li>
					<a href="contact.html">Contact</a>
				</li>
				<li>
					<a href="blog.html">Blog</a>
				</li>
			






// link is the file label is the key
foreach($nav1 as $link => $label)
{
    echo "link is $link and label is $label<br />";
    
}
*/

//echo $title;

//die;
/*
Creates links inside the header.php file

<li><a href="LINK">LABEL</a></li>

<li class="active"><a href="LINK">LABEL</a></li>

*/
function makeLinks($arr,$prefix='',$suffix='',$exception='')
{
    $myReturn = '';//String return for function
    foreach($arr as $link => $label)
    {
        if(THIS_PAGE == $link)
        {//current file gets active class
            
            $myReturn .= $exception . '<a href="' . $link . '">' . $label . '</a>' . $suffix;
        
        
        }else{
        
            $myReturn .= $prefix . '<a href="' . $link . '">' . $label . '</a>' . $suffix;
            
        }
    }
    
    return $myReturn;
}//end makeLinks()

//COMMENT THIS OUT FOR THE PREIVOUS ASSIGNMENT!

/*
Allows us to send an email that respects the server domain spoofing polices of 
hosts like DH.

$response = safeEmail($to, $subject, $message, $replyTo='','html');

if($response)
{
    echo 'hopefully HTML email sent!<br />';
}else{
   echo 'Trouble with HTML email!<br />'; 
}

*/
function safeEmail($to, $subject, $message, $replyTo = '',$contentType='text')
{
    $fromAddress = "Automated Email <noreply@" . $_SERVER["SERVER_NAME"] . ">";

    if(strtolower($contentType)=='html')
    {//change to html format
        $contentType = 'Content-type: text/html; charset=iso-8859-1';
    }else{
        $contentType = 'Content-type: text/plain; charset=iso-8859-1';
    }
    
    $headers[] = "MIME-Version: 1.0";//optional but more correct
    //$headers[] = "Content-type: text/plain; charset=iso-8859-1";
    $headers[] = $contentType;
    //$headers[] = "From: Sender Name <sender@domain.com>";
    $headers[] = 'From: ' . $fromAddress;
    //$headers[] = "Bcc: JJ Chong <bcc@domain2.com>";
    //$headers[] = "Reply-To: Recipient Name <receiver@domain3.com>";
    
    if($replyTo !=''){
        $headers[] = 'Reply-To: ' . $replyTo;   
    }
    
    
    $headers[] = "Subject: {$subject}";
    $headers[] = "X-Mailer: PHP/". phpversion();
    
    $headers = implode(PHP_EOL,$headers);

    
    return mail($to, $subject, $message, $headers);

}//end safeEmail()


function process_post()
{//loop through POST vars and return a single string
    $myReturn = ''; //set to initial empty value

    foreach($_POST as $varName=> $value)
    {#loop POST vars to create JS array on the current page - include email
         $strippedVarName = str_replace("_"," ",$varName);#remove underscores
        if(is_array($_POST[$varName]))
         {#checkboxes are arrays, and we need to collapse the array to comma separated string!
             $myReturn .= $strippedVarName . ": " . implode(",",$_POST[$varName]) . PHP_EOL;
         }else{//not an array, create line
             $myReturn .= $strippedVarName . ": " . $value . PHP_EOL;
         }
    }
    return $myReturn;
} 