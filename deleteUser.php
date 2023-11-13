<?php
include 'php/sessionManager.php';
include 'models/users.php';
include 'models/photos.php';

userAccess();
if (isset($_POST['userId'])) {
    $userIdToDelete = (int) $_POST['userId'];

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
if (!function_exists('redirect')) {
    function redirect($url)
    {
        header('Location: ' . $url);
        exit();
    }
}
?>