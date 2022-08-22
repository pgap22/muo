
<?php  
use MUO\Usuarios;
$user = Usuarios::find($_SESSION["user_id"]);
?>
    <!-- Home Css -->
    <link rel="preload" href="../css/header-home/mobile/style.css" as="style">
    <link rel="stylesheet" href="../css/header-home/mobile/style.css" media="(max-width: 520px)">

    <link rel="preload" href="../css/header-home/tablet/style.css" as="style">
    <link rel="stylesheet" href="../css/header-home/tablet/style.css" media="(min-width: 521px) and (max-width: 1023px)">

    <link rel="preload" href="../css/header-home/desktop/style.css" as="style">
    <link rel="stylesheet" href="../css/header-home/desktop/style.css" media="(min-width: 1024px)">


    <script src="../../js/componentHandler.js" type="module"></script>
    <script src="../../js/menuHome.js" defer></script>

    <header class="header">
       <div class="header__container">
            
            <a href="/" class="header__logo-img">
                <img class="header__img" src="../img/logo/logo.svg" alt="Logo">
            </a>
          

            <div class="header__search-bar no-mobile">
                <img src="/img/icons/search.svg" alt="Search Icon" class="header__search-ico">
                <input type="text" id="search-expo" name="search-expo" class="header__input-search">
            </div>

            <div class="header__user">
                <div class="header__user-data">
                    <p class="header__user-name"><?= $user->name ?></p>
                    <p class="header__user-last-name"><?= $user->last_name ?></p>
                </div>
                <img class="header__icon-user header__show" src="../img/icons/user.svg" alt="">
                
                <img class="header__dots-menu header__show disabled-tablet-home " src="../img/icons/dots-menu.svg" alt="Kebab Menu">
                
                <div class="header__black-screen "></div>
                
                <div class="header__options ocultar">                    
                    

                    <div class="header__close-options home-menu-toggle">
                        <img src="../img/icons/cancel.svg" alt="">
                    </div>

                    <div class="header__pages">
                         
                    </div>


                </div>


            </div>
       </div>
    </header>