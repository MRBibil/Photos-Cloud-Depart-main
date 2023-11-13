<?php
include 'php/sessionManager.php';
include 'models/users.php';

if (isset($_POST['userId'])) {
    $userId = (int) $_POST['userId'];

    $usersFile = new UsersFile(UsersFile);
    $user = $usersFile->get($userId);

    if ($user !== null) {
        if ($user->isAdmin() == true) {
            $user->isAdmin() = 0;
        } else {
            $user->isAdmin() = 1;
        }
        $usersFile->update($user);

        redirect('gestionUsager.php');
        exit();
    }
} else {
    exit('aucun ID utilisateur fourni');
}

function currentUserIsAdmin()
{
    return $_SESSION['userType'] == 1;
}

?>