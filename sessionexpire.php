<?php
session_start();
include("includes/config.php");

$_SESSION['errmsg']="Session Expired";
?>
<script language="javascript">
document.location="index.php";
</script>