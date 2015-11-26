<?php include 'includes/config.php';?>
<?php include 'includes/header.php';?>

<h1><?=$pageID?></h1>
<?php
//data1_list.php - shows a list of customer data
$iConn = mysqli_connect(DB_HOST,DB_USER,DB_PASSWORD,DB_NAME);

$sql = "select * from tortoise_hats";

//we extract the data here
$result = mysqli_query($iConn,$sql);


if(mysqli_num_rows($result) > 0)
{//show records
    while($row = mysqli_fetch_assoc($result))
    {

        echo '<p>';
        echo 'HatName: <b>' . ' ' . $row['HatName'] . '</b>';
        echo ' ' . 'HatPrice: <b>' . ' ' . '$' . $row['HatPrice'] . '</b>';
        
        echo '<a href="data1_view.php?id=' . ' ' . $row['CustomerID'] . '">' . ' ' . $row['HatName'] . '</a>';
        
        echo '</p>';

    }   
    
}else{// inform no records
        echo '<p>Currently no tortoise hats for sale</p>';


}

// release web server resources
@mysqli_free_result($result);    

//close connection to mysql
@mysqli_close($iConn);
    
?>
<!-- FOOTER STARTS HERE -->
<?php include 'includes/footer.php';?>
<!-- FOOTER ENDS HERE -->