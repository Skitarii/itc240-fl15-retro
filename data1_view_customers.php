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

$sql = "select * from test_Customers where CustomerID = $id";

//we extract the data here
$result = mysqli_query($iConn,$sql);


if(mysqli_num_rows($result) > 0)
{//show records
    while($row = mysqli_fetch_assoc($result))
    {
        $FirstName = stripslashes($row['FirstName']);
        $LastName = stripslashes($row['LastName']);
        $Email = stripslashes($row['Email']);
        $title = "Title Page for " . $FirstName;
        $pageID = $FirstName;
        $Feedback = ''; //no feedback necessary
    }   
    
}else{// inform no records
        $Feedback = '<p>This customer does not exist</p>';


}

?>
<?php include 'includes/header.php';?>
<!-- HEADER ENDS HERE -->
<h1><?=$pageID?></h1>
<?php
    
    
if($Feedback == '')
{// data exists, show it
    echo '<p>';
    echo 'Firstname: <b>' . ' ' . $FirstName . '</b>';
    echo ' ' . 'Lastname: <b>' . ' ' . $LastName . '</b>';
    echo ' ' . 'Email: <b>' . ' ' . $Email . '</b>';

    echo '<img src="upload/customer' . $id . '.jpg" />';
    
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