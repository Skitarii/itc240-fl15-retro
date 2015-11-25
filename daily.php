<!-- HEADER STARTS HERE -->
<?php include 'includes/config.php';?>
<?php include 'includes/header.php';?>

<?php

if(isset($_GET['day']))
{//show the selected day
    $myDay = $_GET['day'];

}else{//show today
    
    $myDay = date('l');

}

//die;

//$myDay = date('l'); //holds the day variable
$myPic = ''; //holds daily picture
$myPicAlt = ''; //holds an alt statement for daily picture
$myDrink = ''; //holds daily drink name
//$myDay = "Sunday";
switch($myDay){

    case 'Monday':
        $myPic ="pumpkin-spice-latte.jpg";
        $myPicAlt = "Pumpkin spiced latte. Get it while the season lasts!";
        $myDrink ="Pumpkin spiced latte";
        break;
        
        
    case 'Tuesday':
        $myPic ="iced-coffee.jpg";
        $myPicAlt ="Cool and Delicious iced coffee!";
        $myDrink ="Iced Coffee";
        break;
        
    
    case 'Wednesday':
        $myPic ="cappuccino.jpg";
        $myPicAlt ="Classy and yummy cappuccino!";
        $myDrink ="Cappuccino";
        break;
        
        
    case 'Thursday':
        $myPic ="thor-coffee-mug.jpg";
        $myPicAlt ="By Odin's Beard! This is a good Brew!";
        $myDrink ="Thor's Day Espresso";
        break;
        
        
    case 'Friday':
        $myPic ="mocha-latte.jpg";
        $myPicAlt ="Mocha latte, a chocolate lover's delight!";
        $myDrink ="Mocha Latte";
        break;
        
        
    case 'Saturday':
        $myPic ="coffee-martini.jpg";
        $myPicAlt ="I like my Martini dirty with chocolate!";
        $myDrink ="Choco Martini";
        break;
        
        
    case 'Sunday':
        $myPic ="coffee-skull.jpg";
        $myPicAlt ="Rise from your grave with this extra dark brew!";
        $myDrink ="Wake the Dead Coffee";
        break;


}

?>





<!-- HEADER ENDS HERE -->
<h1><?=$pageID?></h1>

<img src="images/<?=$myPic?>" alt="<?=$myPicAlt?>" />

<p>The day is <?=$myDay?> and the drink is <?=$myDrink?></p>

<p><a href="daily.php?day=Sunday">Sunday</a></p>
<p><a href="daily.php?day=Monday">Monday</a></p>
<p><a href="daily.php?day=Tuesday">Tuesday</a></p>
<p><a href="daily.php?day=Wednesday">Wednesday</a></p>
<p><a href="daily.php?day=Thursday">Thursday</a></p>
<p><a href="daily.php?day=Friday">Friday</a></p>
<p><a href="daily.php?day=Saturday">Saturday</a></p>
<!-- FOOTER STARTS HERE -->
<?php include 'includes/footer.php';?>
<!-- FOOTER ENDS HERE -->