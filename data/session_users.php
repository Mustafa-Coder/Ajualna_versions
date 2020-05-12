<?php
$_SESSION['id'] = $rowQuery['userid'];
$_SESSION['user'] = $rowQuery['username'];
$_SESSION['last'] = $rowQuery['lastname'];
$_SESSION['email'] = $rowQuery['email'];
$_SESSION['sax'] = $rowQuery['Gender'];
$_SESSION['nationalNum'] = $rowQuery['nationalNum'];
$_SESSION['college'] = $rowQuery['college'];
$_SESSION['admin'] = $rowQuery['admin'];
$_SESSION['num'] = $rowQuery['numberphone'];
$_SESSION['avatar'] = $rowQuery['avatar'];
$_SESSION['lang'] = $rowQuery['languages'];
$_SESSION['country'] = $rowQuery['country'];
