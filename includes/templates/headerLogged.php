
    <!-- Home Css -->
    <link rel="preload" href="../css/homePage/mobile/style.css" as="style">
    <link rel="stylesheet" href="../css/homePage/mobile/style.css" media="(max-width: 520px)">
    <!-- Home Css -->
    <link rel="preload" href="../css/homePage/desktop/style.css" as="style">
    <link rel="stylesheet" href="../css/homePage/desktop/style.css" media="(min-width: 1024px)">

    <link rel="stylesheet" href="../css/homePage/tablet/style.css" media="(min-width: 521px) and (max-width: 1023px)">

    <script src="../../js/menuHome.js" defer></script>
    
    <header class="header">
       <div class="header__container">
            
            <img class="header__img" src="../img/logo/logo.svg" alt="Logo" >
          

            <div class="header__search-bar no-mobile">
                <img src="/img/icons/search.svg" alt="Search Icon" class="header__search-ico">
                <input type="text" id="search-expo" name="search-expo" class="header__input-search">
            </div>

            <div class="header__user">
                <div class="header__user-data">
                    <p class="header__user-name">Nombre</p>
                    <p class="header__user-last-name">Apellido</p>
                </div>
                <img class="header__icon-user header__show" src="../img/icons/user.svg" alt="">
                
                <img class="header__dots-menu header__show no-tablet" src="../img/icons/dots-menu.svg" alt="Kebab Menu">
                
                <div class="header__black-screen disabled-tablet"></div>
                
                <div class="header__options ocultar">                    
                    

                    <div class="header__close-options header__show">
                        <img src="../img/icons/cancel.svg" alt="">
                    </div>

                    <div class="header__pages">
                    
                        <div class="header__link">
                            <img src="../img/icons/settings.svg" class="header__page-icon" alt="settings Icon">
                            <p>Configurar mi perfil</p>
                        </div>

                        <div class="header__link">
                            <img src="../img/icons/Home.svg" alt="" class="header__page-icon">
                            <p>Pagina principal</p>
                        </div>
                        <div class="header__link">
                            <img src="../img/icons/about.svg" alt="" class="header__page-icon">
                            <p>Sobre Nosotros</p>
                        </div>
                        <div class="header__link">
                            <img src="../img/icons/museum.svg" alt="" class="header__page-icon">
                            <p>Museos</p>
                        </div>

                        <a href="logout.php">
                            <div class="header__link header__link--logout">
                                <img src="../img/icons/logout.svg" alt="Logout Icon" class="header__logout-icon">
                                <p class="header__logout-text">Cerrar Sesion</p>
                            </div>
                        </a>
                    </div>


                </div>
            </div>
       </div>
    </header>