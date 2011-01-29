<?
include("database.php");

$image	= mysql_real_escape_string($_GET['image']);
$code		= mysql_real_escape_string($_GET['code']);

$addr = mysql_real_escape_string($_SERVER['REMOTE_ADDR']);
// XXX: redhat - 20100129 - This busts the cache when there is a query which goes first through the cache:global:80 then to apache:localhost:80
if( !is_null($_SERVER['HTTP_X_FORWARD_FOR'])) {
	  $addr = mysql_real_escape_string($_SERVER['HTTP_X_FORWARD_FOR']);
}
// XXX: redhat - 20100129 - I doubt this actually does anything, but I added it anyway
if( !is_null($_SERVER['HTTP_X_FORWARDED_FOR'])) {
	  $addr = mysql_real_escape_string($_SERVER['HTTP_X_FORWARDED_FOR']);
}

$r = rand(0,1);

$sql = "INSERT INTO `abtester` (`code`, `addr`, `r`, `time`) VALUES('$code', '$addr', '$r', UNIX_TIMESTAMP()) ON DUPLICATE KEY UPDATE `time`=UNIX_TIMESTAMP()";

$db->query($sql);

$sql = "SELECT `id`,`r` FROM `abtester` WHERE `addr` = '$addr' AND `code` = '$code'";

$results = $db->query($sql);

$result = $results->fetch_array();

$r	= $result['r'];
$id	= $result['id'];

$results->free();

if($image == "true") {
	$sql = "SELECT `id`,`image` as `file` FROM `abtest` WHERE `code`='$code'";
} else {
	$sql = "SELECT `id`,`url` as `file` FROM `abtest` WHERE `code`='$code'";
}

$results = $db->query($sql);

$result = array();

for( $i = 0; $i < $results->num_rows; $i++) {
	$result[$i] = $results->fetch_array( MYSQLI_ASSOC);
}

$sql = "UPDATE `abtester` SET `abtest_id`='". $result[$r]['id'] ."' WHERE `addr` = '$addr' AND `code` = '$code'";

$db->query($sql);

header("Location: ". $result[$r]['file']);
#echo ("Location: ". $result[$r]['file']);

$results->free();

?>
