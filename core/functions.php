<?php 
session_start();

function emptyUser ($grantAccessGuest = false) {
    if (!empty($_SESSION['user']) OR ($grantAccessGuest AND !empty($_SESSION['guest']))) {
        return; 
    }
    header($_SERVER['SERVER_PROTOCOL'] . ' 403 Forbidden');
    die('403 Forbidden');
}

function emptyTestName () {
    header($_SERVER['SERVER_PROTOCOL'] . ' 404 Not Found'); 
    die('404 Not Found');
}

function login($login, $password)
{
    $user = getUser($login);
    if ($user && $user['password'] == $password) {
        $_SESSION['user'] = $user;
        return true;
    }
    return false;
}
function guest($login) {
	$_SESSION['guest'] = $login;
	return true;
}
function getUser($login)
{
    $users = getUsers();
    foreach ($users as $user) {
        if ($user['login'] == $login) {
            return $user;
        } 
    }
 	return null;
}
function getUsers()
{
    $usersData = file_get_contents('users/login.json');
    if (!$usersData) {
        return [];
    }
    $users = json_decode($usersData, true);
    if (!$users) {
        return [];
    }
    return $users;
}

function whoUR () {
    if (!empty($array['arrayElement']) == ['user']['username']) { 
    echo ", " . $_SESSION['user']['username'];} 
    elseif (!empty($array['arrayElement']) == ['guest'])  {
    echo ", " . $_SESSION['guest'];}
    else {echo " ";}
}
?>
