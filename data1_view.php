<!-- HEADER STARTS HERE -->
<?php include 'includes/config.php';?>
<?php
//data1_view.php - shows details of a single customer


//process querystring here 
if(isset($_GET['id']))
{//process data
    //cast the data to an integer for security purposes!!
    $id = (int)$_GET['id'];
}else{//redirect to safe page
    header('Location:data1_list.php');


}

$iConn = mysqli_connect(DB_HOST,DB_USER,DB_PASSWORD,DB_NAME);

$sql = "select * from tortoise_hats where CustomerID = $id";

//we extract the data here
$result = mysqli_query($iConn,$sql);


if(mysqli_num_rows($result) > 0)
{//show records
    while($row = mysqli_fetch_assoc($result))
    {
        $HatName = stripslashes($row['HatName']);
        $HatPrice = stripslashes($row['HatPrice']);
        $HatPic = stripslashes($row['HatPic']);
        $title = "Title Page for " . $HatName;
        $pageID = $HatName;
        $Feedback = ''; //no feedback necessary
    }   
    
}else{// inform no records
        $Feedback = '<p>This hat does not exist</p>';


}

?>
<?php include 'includes/header.php';?>
<!-- HEADER ENDS HERE -->
<h1><?=$pageID?></h1>
<?php
    
    
if($Feedback == '')
{// data exists, show it
    echo '<p>';
    echo 'Hat Name: <b>' . ' ' . $HatName . '</b>';
    echo ' ' . 'Hat Price: <b>' . ' ' . '$' . $HatPrice . '</b>';

    echo '<img src="upload/' . $HatPic . '.jpg" />';
    
    echo '</p>'; 
    
     
    
}else{// warn user no data
    echo $Feedback;
    
}

echo '<p><a href ="data1_list.php">Go Back</a></p>';

// release web server resources
@mysqli_free_result($result);    

//close connection to mysql
@mysqli_close($iConn);
    
?>
<!-- FOOTER STARTS HERE -->
<?php include 'includes/footer.php';?>
<!-- FOOTER ENDS HERE -->