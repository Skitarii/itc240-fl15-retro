<?php
/**
 * demo_list_pager.php demonstrates a list page that paginates data across 
 * multiple pages
 * 
 * This page uses a Pager class which processes a mysqli SQL statement 
 * and spans records across multiple pages. 
 * 
 * @package nmPager
 * @author Bill Newman <williamnewman@gmail.com>
 * @version 3.2 2015/11/24
 * @link http://www.newmanix.com/
 * @license http://www.apache.org/licenses/LICENSE-2.0 v. 3.0
 * @see MyAutoLoader.php
 * @see Pager.php 
 * @todo none
 */

require 'includes/config.php'; #provides configuration, pathing, error handling, db credentials 
 
# SQL statement
$sql = "select * from test_Customers";// change to my data 

#Fills <title> tag  
$title = 'Customer List/View/Pager';// change to my data

# END CONFIG AREA ---------------------------------------------------------- 

include 'includes/header.php'; #header must appear before any HTML is printed by PHP
?>
<h3 align="center"><?=THIS_PAGE;?></h3>

<p>This page demonstrates a List/View/Pager web application.</p>
<p>It adds the <b>Pager</b> class to add pagination to our pages.</p>
<p>Take the code from it to enable paging on your pages!</p>
<?php
#reference images for pager
$prev = '<img src="' . VIRTUAL_PATH . 'images/arrow_prev.gif" border="0" />';// need this
$next = '<img src="' . VIRTUAL_PATH . 'images/arrow_next.gif" border="0" />';// need this

#Create a connection
# connection comes first in mysqli (improved) function
$iConn = @mysqli_connect(DB_HOST,DB_USER,DB_PASSWORD,DB_NAME) or die(myerror(__FILE__,__LINE__,mysqli_connect_error()));// need the or statement to add to my iConn


# Create instance of new 'pager' class
$myPager = new Pager(2,'',$prev,$next,''); // need and change to my data
$sql = $myPager->loadSQL($sql,$iConn);  #load SQL, pass in existing connection, add offset // important! calculates some cool stuff using the object 
$result = mysqli_query($iConn,$sql) or die(myerror(__FILE__,__LINE__,mysqli_error($iConn)));

if(mysqli_num_rows($result) > 0)
{#records exist - process
	if($myPager->showTotal()==1){$itemz = "customer";}else{$itemz = "customers";}  //deal with plural // need
    echo '<p align="center">We have ' . $myPager->showTotal() . ' ' . $itemz . '!</p>'; //need
	while($row = mysqli_fetch_assoc($result))
	{# process each row
         echo '<p align="center">
            <a href="' . VIRTUAL_PATH . 'customer_view.php?id=' . (int)$row['CustomerID'] . '">' . dbOut($row['FirstName']) . '</a>
            </p>';
	}
	//the showNAV() method defaults to a div, which blows up in our design
    echo $myPager->showNAV();//show pager if enough records // this creates the arrows for the next and prev pages and track where you are comment this out and uncomment 65
    
    //the version below adds the optional bookends to remove the div design problem
    //echo $myPager->showNAV('<p align="center">','</p>'); // uncomment this to get rid of the red boarder on the divs
}else{#no records
    echo "<p align=center>What! No Customers?  There must be a mistake!!</p>";	
}
@mysqli_free_result($result);
@mysqli_close($iConn);

include 'includes/footer.php';
?>
