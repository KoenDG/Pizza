<?php

session_start();
session_destroy();

//En terug naar login
header('Location: login.php');