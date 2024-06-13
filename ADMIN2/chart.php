<?php
 include_once("connections/connection.php");
 $con = connection();
$dataPoints = array( 
	array("y" => 3373.64, "label" => "Germany" ),
	array("y" => 2435.94, "label" => "France" ),
	array("y" => 1842.55, "label" => "China" ),
	array("y" => 1828.55, "label" => "Russia" ),
	array("y" => 1039.99, "label" => "Switzerland" ),
	array("y" => 765.215, "label" => "Japan" ),
	array("y" => 612.453, "label" => "Netherlands" )
);
$test = array();
$count = 0;

$res = mysqli_query($con, "SELECT  Amount, MembershipType from payment");
while($row = mysqli_fetch_array($res)){
    $test[$count]["label"] = $row["MembershipType"];
    $test[$count]["y"] = $row["Amount"];
    $count=$count+1;
}
?>
<!DOCTYPE HTML>
<html>
<head>
<script>
    window.onload = function() {
    
    var chart = new CanvasJS.Chart("chartContainer", {
        animationEnabled: true,
        theme: "light2",
        title:{
            text: "Membership Plan"
        },
        axisY: {
            title: "Number of Enrolled Members"
        },
        data: [{
            type: "column",
            yValueFormatString: "#,##0.##",
            dataPoints: <?php echo json_encode($test, JSON_NUMERIC_CHECK); ?>
        }]
    });
    chart.render();
    
    }
</script>
</head>
                           