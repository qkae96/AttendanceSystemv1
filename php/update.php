<!DOCTYPE html>
<html>
<body>

<h1>My First Heading</h1>
<p>My first paragraph.</p>
<?php
if ( ! empty( $_GET['evtID'] ) ) {
	echo "JS says " . $_GET['evtID']; // Outputs : JS says Hi!
}
 ?>

</body>
</html>
