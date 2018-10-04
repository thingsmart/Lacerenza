<?php
session_start();

unset($_SESSION['username']);
unset($_SESSION['id_utente']);

$home = "../index.php";
?>

<!-- Scripts -->
<script src="js/JQuery/jquery-1.9.1.min.js" type="text/javascript"></script>
<script src="js/JQuery/jquery-ui-1.10.3.custom.min.js" type="text/javascript"></script>
<script src="js/JQuery/jquery.cookie.min.js" type="text/javascript" ></script>
        
<script>
	window.location = "<?= $home ?>";
</script>
