<?php
session_start();

session_unset();
session_abort();
session_write_close();

header_remove('Set-Cookie');
