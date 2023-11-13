<?php
include 'php/sessionManager.php';
include_once "models/Users.php";

userAccess();
$viewTitle = "Liste des usagers";
$list = UsersFile()->toArray();
$viewContent = "";

foreach ($list as $User) {
    $id = strval($User->id());
    $name = $User->name();
    $email = $User->Email();
    $avatar = $User->Avatar();
    $isBlocked = $User->isBlocked();

    $lockIcon = $isBlocked ? "<i class='fa-solid fa-user-lock' style='color: #ff0033;'></i>" : "<i class='fa-solid fa-user-lock' style='color: #2bff00;'></i>";
    $blockUnblockText = $isBlocked ? "Débloquer" : "Bloquer";

    $isAdmin = $User->isAdmin();
    $adminIcon = $isAdmin ? "<i class='fa-solid fa-user-shield' style='color: #2bff00;'></i>" : "<i class='fa-solid fa-user-shield' style='color: #ff0033;'></i>";
    $AdminOuNon = $isAdmin ? "Est Admin" : "Non Admin";

    $UserHTML = <<<HTML
    <div class="UserRow" User_id="$id">
        <div class="UserContainer noselect">
            <div class="UserLayout">
                <div class="UserAvatar" style="background-image:url('$avatar')"></div>
                <div class="UserInfo">
                    <span class="UserName">$name</span>
                    <a href="mailto:$email" class="UserEmail" target="_blank" >$email</a>

                    <form action="deleteUser.php" method="post">
                        <input type="hidden" name="userId" value="$id">
                        <label class="icon-button">
                        <i class="fa-solid fa-trash"></i>
                        <input type="submit" value="Supprimer" style="display: none;">
                        </label>
                    </form>
                    
                    <form action="blockUser.php" method="post" style="display:inline;">
                        <input type="hidden" name="userId" value="$id">
                        <label class="icon-button">
                        <input type="submit" class="lock-button" style="display: none;">$lockIcon
                        </label>
                    </form>
                    
                    <form action="grantAdmin.php" method="post" style="display:inline;">
                        <input type="hidden" name="userId" value="$id">
                        <label class="icon-button">
                        <input type="submit" style="display: none;"> $adminIcon
                        </label>
                    </form>
                </div>
            </div>
        </div>
    </div>           
    HTML;
    $viewContent = $viewContent . $UserHTML;
}


$viewScript = <<<HTML
    <script src='js/session.js'></script>
    <script defer>
        $("#addPhotoCmd").hide();
    </script>
HTML;

include "views/master.php";
