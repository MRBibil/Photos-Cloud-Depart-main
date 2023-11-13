<?php
include 'php/sessionManager.php';
include 'models/users.php';

// if (!currentUserIsAdmin()) {
//     exit('Vous n\'avez pas les droits nécessaires pour effectuer cette action.');
// }

if (isset($_POST['userId'])) {
    $userId = (int) $_POST['userId'];

    $usersFile = new UsersFile(UsersFile);
    $user = $usersFile->get($userId);

    if ($user !== null) {
        if ($user->isAdmin()) {
            $user->revokeAdmin();
        } else {
            $user->grantAdmin();
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