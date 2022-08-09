<?php
include "../includes/app.php";


protegerHome();

?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="theme-color" content="black">
    <meta name="description" content="Un sitio web de museos">
    <title>MUO - PAGINA PRINCIPAL</title>
    <link rel="shortcut icon" href="../img/favicon.png" type="image/x-icon">

    <!-- Home css -->
    <link rel="stylesheet" href="../css/homePage/mobile/style.css" media="(max-width: 520px)">
    <link rel="stylesheet" href="../css/homePage/tablet/style.css" media="(min-width: 521px) and (max-width: 1023px)">
    <link rel="stylesheet" href="../css/homePage/desktop/style.css" media="(min-width: 1024px)">

    <!--Font-->
    <link rel="preload" href="../fonts/font.css" as="style">
    <link rel="stylesheet" href="../fonts/font.css">

    <!--Custom Properties-->
    <link rel="preload" href="../css/general/general.css" as="style">
    <link rel="stylesheet" href="../css/general/general.css">



</head>

<body>
    

    <?php
    showHeader();
    ?>

    <main class="main">
        <div class="main__container">
            
            <aside class="main__nav no-mobile">
                <div class="main__nav-container">
                    <div class="main__nav-icon main__selected-page">
                        <img class="main__nav-img " src="../img/icons/feed.svg" alt="Feed icon">
                        <p class="show-only-desktop">Feed</p>
                    </div>
                    <div class="main__nav-icon">
                        <img class="main__nav-img" src="../img/icons/favorite.svg" alt="Feed icon">
                        <p class="show-only-desktop">Favoritos</p>
                    </div>
                    <div class="main__nav-icon">
                        <img class="main__nav-img" src="../img/icons/explore.svg" alt="Feed icon">
                        <p class="show-only-desktop">Explorar</p>
                    </div>
                    <div class="main__nav-icon menu__setting-show home-menu-toggle">
                        <img class="main__nav-img" src="../img/icons/more-options.svg" alt="Feed icon">
                        <p class="show-only-desktop">Ajustes</p>
                    </div>

                </div>
            </aside>

            
            <div class="main__feed-wrapper">
                <h1 class="main__title">Bienvenido a MUO</h1>
                <div class="main__feed">
                    
                    
                    <div class="main__expo-container">
                        <div class="main__expo-photo">
                            <img src="../museos/marte/monumento_revolucion/image.jpg" alt="Museum Img" class="main__expo-img">
                        </div>
                        <div class="main__expo-description">
                            <div class="main__expo-data">
                                <h3 class="main__expo-title">Lorem Ipsum</h3>
                                <div class="main__expo-interactions">
                                    <img src="../img/icons/comment.svg" alt="comment icon" class="main__expo-icons main__expo--comment-icon">
                                    <img src="../img/icons/favorite.svg" alt="comment icon" class="main__expo-icons">
                                </div>
                        </div>

                            <p class="main__expo-text">Lorem ipsum dolor sit, amet consectetur adipisicing elit. Doloremque officia, eum ipsam reprehenderit similique ex.</p>
                            
                        </div>
                    </div>

                    
                    
                    <div class="main__expo-container">
                        <div class="main__expo-photo">
                            <img src="../museos/marte/monumento_revolucion/image.jpg" alt="Museum Img" class="main__expo-img">
                        </div>
                        <div class="main__expo-description">
                            <div class="main__expo-data">
                                <h3 class="main__expo-title">Lorem Ipsum</h3>
                                <div class="main__expo-interactions">
                                    <img src="../img/icons/comment.svg" alt="comment icon" class="main__expo-icons main__expo--comment-icon">
                                    <img src="../img/icons/favorite.svg" alt="comment icon" class="main__expo-icons">
                                </div>
                        </div>

                            <p class="main__expo-text">Lorem ipsum dolor sit, amet consectetur adipisicing elit. Doloremque officia, eum ipsam reprehenderit similique ex.</p>
                            
                        </div>
                    </div>

                    
                    
                    <div class="main__expo-container">
                        <div class="main__expo-photo">
                            <img src="../museos/marte/monumento_revolucion/image.jpg" alt="Museum Img" class="main__expo-img">
                        </div>
                        <div class="main__expo-description">
                            <div class="main__expo-data">
                                <h3 class="main__expo-title">Lorem Ipsum</h3>
                                <div class="main__expo-interactions">
                                    <img src="../img/icons/comment.svg" alt="comment icon" class="main__expo-icons main__expo--comment-icon">
                                    <img src="../img/icons/favorite.svg" alt="comment icon" class="main__expo-icons">
                                </div>
                        </div>

                            <p class="main__expo-text">Lorem ipsum dolor sit, amet consectetur adipisicing elit. Doloremque officia, eum ipsam reprehenderit similique ex.</p>
                            
                        </div>
                    </div>

                    
                    
                    <div class="main__expo-container">
                        <div class="main__expo-photo">
                            <img src="../museos/marte/monumento_revolucion/image.jpg" alt="Museum Img" class="main__expo-img">
                        </div>
                        <div class="main__expo-description">
                            <div class="main__expo-data">
                                <h3 class="main__expo-title">Lorem Ipsum</h3>
                                <div class="main__expo-interactions">
                                    <img src="../img/icons/comment.svg" alt="comment icon" class="main__expo-icons main__expo--comment-icon">
                                    <img src="../img/icons/favorite.svg" alt="comment icon" class="main__expo-icons">
                                </div>
                        </div>

                            <p class="main__expo-text">Lorem ipsum dolor sit, amet consectetur adipisicing elit. Doloremque officia, eum ipsam reprehenderit similique ex.</p>
                            
                        </div>
                    </div>

                    
                    
                    <div class="main__expo-container">
                        <div class="main__expo-photo">
                            <img src="../museos/marte/monumento_revolucion/image.jpg" alt="Museum Img" class="main__expo-img">
                        </div>
                        <div class="main__expo-description">
                            <div class="main__expo-data">
                                <h3 class="main__expo-title">Lorem Ipsum</h3>
                                <div class="main__expo-interactions">
                                    <img src="../img/icons/comment.svg" alt="comment icon" class="main__expo-icons main__expo--comment-icon">
                                    <img src="../img/icons/favorite.svg" alt="comment icon" class="main__expo-icons">
                                </div>
                        </div>

                            <p class="main__expo-text">Lorem ipsum dolor sit, amet consectetur adipisicing elit. Doloremque officia, eum ipsam reprehenderit similique ex.</p>
                            
                        </div>
                    </div>

                    
                    
                    <div class="main__expo-container">
                        <div class="main__expo-photo">
                            <img src="../museos/marte/monumento_revolucion/image.jpg" alt="Museum Img" class="main__expo-img">
                        </div>
                        <div class="main__expo-description">
                            <div class="main__expo-data">
                                <h3 class="main__expo-title">Lorem Ipsum</h3>
                                <div class="main__expo-interactions">
                                    <img src="../img/icons/comment.svg" alt="comment icon" class="main__expo-icons main__expo--comment-icon">
                                    <img src="../img/icons/favorite.svg" alt="comment icon" class="main__expo-icons">
                                </div>
                        </div>

                            <p class="main__expo-text">Lorem ipsum dolor sit, amet consectetur adipisicing elit. Doloremque officia, eum ipsam reprehenderit similique ex.</p>
                            
                        </div>
                    </div>


                </div>
            </div>
            
            
        </div>
    </main>

    <div class="menu-phone no-tablet">
        <div class="menu-phone__container">
            <div class="menu-phone__icon menu-phone__icon--active">
                <img src="../img/icons/feed.svg" alt="" class="menu-phone__icon-img ">
            </div>
            <div class="menu-phone__icon">
                <img src="../img/icons/favorite.svg" alt="" class="menu-phone__icon-img ">
            </div>
            <div class="menu-phone__icon">
                <img src="../img/icons/explore.svg" alt="" class="menu-phone__icon-img ">
            </div>
            <div class="menu-phone__icon">
                <img src="../img/icons/search.svg" alt="" class="menu-phone__icon-img ">
            </div>
        </div>
    </div>
</body>
</html>