<?php
require_once($_SERVER['DOCUMENT_ROOT'] . '/utils/utils.php');
Utils::cors();

session_start();

session_unset();
session_abort();
session_write_close();

header_remove('Set-Cookie');
