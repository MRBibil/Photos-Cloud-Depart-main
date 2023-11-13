<?php
include 'php/sessionManager.php';
include 'models/users.php';

// if (!currentUserIsAdmin()) {
//     exit('Vous n\'avez pas les droits nécessaires pour effectuer cette action.');
// }

if (isset($_POST['userId'])) {
    $userIdToToggleBlock = (int) $_POST['userId'];

    $usersFile = new UsersFile(UsersFile);
    $user = $usersFile->get($userIdToToggleBlock);

    if ($user !== null) {
        if ($user->isBlocked()) {
            $user->unblock();
        } else {
            $user->block();
        }
        $usersFile->update($user);
    }

    redirect('gestionUsager.php');
    exit();
} else {
    exit('Aucun ID utilisateur fourni');
}

// function currentUserIsAdmin()
// {
//     return $_SESSION['userType'] == 1; 
// }
?>