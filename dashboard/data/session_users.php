<?php
$_SESSION['id'] = $rowQuery['userid'];
$_SESSION['user'] = $rowQuery['username'];
$_SESSION['last'] = $rowQuery['lastname'];
$_SESSION['email'] = $rowQuery['email'];
$_SESSION['male'] = $rowQuery['male'];
$_SESSION['women'] = $rowQuery['famale'];
$_SESSION['nationalNum'] = $rowQuery['nationalNum'];
$_SESSION['admin'] = $rowQuery['admin'];
$_SESSION['num'] = $rowQuery['numberphone'];
