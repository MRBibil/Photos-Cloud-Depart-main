<?php
include 'php/sessionManager.php';
include 'models/users.php';

if (isset($_POST['userId'])) {
    $userIdToToggleBlock = (int) $_POST['userId'];

    $usersFile = new UsersFile(UsersFile);
    $user = $usersFile->get($userIdToToggleBlock);

    if ($user !== null) {
        if ($user->isBlocked() == true) {
            $user->isBlocked() = 0;
        } else {
            $user->isBlocked() = 1;
        }
        $usersFile->update($user);
    }

    redirect('gestionUsager.php');
    exit();
} else {
    exit('Aucun ID utilisateur fourni');
}

?>