<?php require_once("ErrorManager.class.php"); ?>
<?php require_once("Mysql.class.php"); ?>

<?php try { // <<<<-------------- try

	$mysql = new Mysql();
	$mysql->connect("HOST", "DATABASE", "USER", "PASSWORD"); // change this line here

	$query = "select * from categories"; // and table name here
	$result = $mysql->query($query);

?>

	<ul>
	<?php foreach ($mysql->fetchAll($result) as $category) { ?>

		<li><?php print_r($category); ?></li>

	<?php } ?>
	</ul>

	<h3>Everything's OK</h3>


<?php } catch (Exception $e) { // <<<<-------------- catch ?>

	<h3>There are errors!</h3>
	<ul>
	<?php foreach (ErrorManager::getInstance()->getErrors() as $error) { ?>

		<li><?php echo $error["message"]; ?></li>	

	<?php } ?>			
	</ul>

<?php } ?>
