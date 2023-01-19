<?php

include ("header_reg.html");

session_start();
if (session_destroy()) {
    header ("Location: index.html");
}

?>