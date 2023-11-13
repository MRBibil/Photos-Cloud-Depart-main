<?php
include 'php/sessionManager.php';
include 'models/users.php';
include 'models/photos.php';

userAccess();
if (isset($_POST['userId'])) {
    $userIdToDelete = (int) $_POST['userId'];

    // if (!currentUserCanDeleteUser($userIdToDelete)) {
    //     // Gérer le cas où l'utilisateur n'a pas le droit de supprimer l'utilisateur.
    //     exit('Opération non autorisée');
    //}

    $photos = PhotosFile()->toArray();
    foreach ($photos as $photo) {
        if ($photo->OwnerId() == $userIdToDelete) {
            PhotosFile()->remove($photo->Id());
        }
    }

    UsersFile()->remove($userIdToDelete);

    redirect('gestionUsager.php');
} else {
    exit('Aucun ID utilisateur fourni');
}


// function currentUserCanDeleteUser($userIdToDelete) {

//     $currentUserId = (int) $_SESSION["currentUserId"];

//     return $isAdmin; // Renvoie true si l'utilisateur actuel peut supprimer, false sinon.
// }
if (!function_exists('redirect')) {
    function redirect($url)
    {
        header('Location: ' . $url);
        exit();
    }
}
?>