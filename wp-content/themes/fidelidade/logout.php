<?php

/* Template Name: Logout */

unset($_SESSION['login_painel']);
session_destroy();
echo "<script>";

echo "window.location.href = '". get_bloginfo('url')."'";

echo "</script>";

