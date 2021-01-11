<?php

include_once($_SERVER['DOCUMENT_ROOT'].'/database/admin_account.php');

$admin_account = new AdminAccount();
$admin_account->setup();