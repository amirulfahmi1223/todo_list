<?php
session_start();
session_destroy();
session_unset();
echo '<script>window.location="../login.php"</script>';
