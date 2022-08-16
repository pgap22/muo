<?php 
include "../../../includes/app.php";
session_start();
$userID = $_SESSION["user_id"];

if(isset($userID)){
    protegerAdmin($userID);
}
else{
    header("location: /");
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- css  -->
    <link rel="stylesheet" href="/css/general/general.css">
    <link rel="stylesheet" href="/fonts/font.css">


    <link rel="stylesheet" href="/css/adminInspect/mobile/style.css">
    <link rel="stylesheet" href="/css/adminInspect/desktop/style.css" media="(min-width: 768px)">

        <!-- css -->
    <link rel="stylesheet" href="/css/headerAdmin/mobile/style.css" media="(max-width: 480px)">
    <link rel="stylesheet" href="/css/headerAdmin/tablet/style.css" media="(min-width: 481px) and (max-width: 1023px)">
    <link rel="stylesheet" href="/css/headerAdmin/desktop/style.css" media="(min-width: 1024px)">

    <title>MUO - PANEL</title>
</head>
<body>
    <?php include "../../../includes/templates/headerAdmin.php" ?>
    
    <main class="main">
        <div class="main__wrapper">
            <div class="main__top">
                <h1 class="main__title">TITULO EXPO</h1>
                <a class="main__go-back" href="/admin/items/expo">Volver</a>
            </div>
            <div class="main__museum-data">
                <div class="main__museum-general">
                    <img class="main__image" src="/museos/marte/monumento_revolucion/image.jpg" alt="Museum Img">
                </div>


                <div class="main__stats-container">
                    <div class="main__stat">
                        <div class="main__data">
                            <p class="main__counter">0</p>
                            <p class="main__text-stat">Comentarios</p>
                        </div>
                        <img class="main__icon-stats" src="/img/icons/com.svg" alt="Comment icon">
                    </div>

                    <div class="main__stat">
                    <div class="main__data">
                            <p class="main__counter">0</p>
                            <p class="main__text-stat">Añadidos a Favoritos</p>
                        </div>
                        <img class="main__icon-stats" src="/img/icons/favorite.svg" alt="Favorite Icon">
                    </div>

                </div>
            </div>

                <div class="main__comments-container">
                    <h2 class="main__comment-title">Comentarios</h2>
                    <div class="main__comment-list">

                        <!-- start comment  -->
                        <div class="main__comment">
                            <div class="main__user">
                                <img class="main__user-icon" src="/img/icons/user.svg" alt="User Icon">

                                <div class="main__user-info">
                                        <p class="main__name">Name, Last name</p>
                                        <p class="main__comment-data">Lorem ipsum, dolor sit amet consectetur adipisicing elit. Inventore eius quidem minima nisi vel assumenda?</p>
                                </div>
                            </div>
                        </div>
                        <!-- end commnet  -->
                        

                        <!-- start comment  -->
                        <div class="main__comment">
                            <div class="main__user">
                                <img class="main__user-icon" src="/img/icons/user.svg" alt="User Icon">

                                <div class="main__user-info">
                                        <p class="main__name">Name, Last name</p>
                                        <p class="main__comment-data">Lorem ipsum, dolor sit amet consectetur adipisicing elit. Inventore eius quidem minima nisi vel assumenda?</p>
                                </div>
                            </div>
                        </div>
                        <!-- end commnet  -->

                        <!-- start comment  -->
                        <div class="main__comment">
                            <div class="main__user">
                                <img class="main__user-icon" src="/img/icons/user.svg" alt="User Icon">

                                <div class="main__user-info">
                                        <p class="main__name">Name, Last name</p>
                                        <p class="main__comment-data">Lorem ipsum, dolor sit amet consectetur adipisicing elit. Inventore eius quidem minima nisi vel assumenda?</p>
                                </div>
                            </div>
                        </div>
                        <!-- end commnet  -->

                    </div>
                </div>

        </div>
    </main>
</body>
</html>