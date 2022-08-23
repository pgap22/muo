    <!--General Styles for responsive Header-->
    <link rel="preload" href="../css/header-footer/mobile.css" as="style">
    <link rel="preload" href="../css/header-footer/tablet.css" as="style">
    <link rel="preload" href="../css/header-footer/desktop.css" as="style">

    <link rel="stylesheet" href="../css/header-footer/mobile.css" media="(max-width: 741px)">
    <link rel="stylesheet" href="../css/header-footer/tablet.css" media="(min-width: 742px) and (max-width: 1024px)">
    <link rel="stylesheet" href="../css/header-footer/desktop.css" media="(min-width: 1024px)">
    <script src="../js/general.js" type="module" defer></script>
<header class="header">

        <img src="../img/icons/hamburguer.svg" alt="menu" class="header__menu">
        <a href="index.php" class="header__logo">
           <picture>
                <source srcset="../img/logo/logo-mobile.svg" media="(max-width: 1024px)">

                <img src="../img/logo/logo.svg" alt="Logo de MUO" title="MUO"class="header__logo">
           </picture>
        </a>

        <nav class="nav">
            <div class="nav__close-menu"></div>
            <ul>
                <li class="nav__btns--center">
                    <div class=" nav__btns">
                        <a href="/pages/register.php" class="  nav__item--active ">
                            <p class="nav__item--btn1" id="btn1">Registrate</p>
                        </a>
                        <a href="/pages/login.php" class="  nav__item--active ">
                            <p class="nav__item--btn2" id="btn2">Inicia Sesion</p>
                        </a>
                    </div>
                </li>
        
                <li class="nav__links">
                    <div class="nav__item">
                        <a href="index.php">
                            <div class="item__icon">
                                <img src="../img/icons/Home.svg" alt="Icono Inicio" title="Inicio">
                                <p id="nav1">Inicio</p>
                            </div> 
                        </a>
                    </div>
                    <div class="nav__item">
                        <a href="/pages/nosotros.php">
                            <div class="item__icon">
                                <img src="../img/icons/about.svg" alt="Icono Sobre Nosotros" title="Sobre Nosotros">
                                <p id="nav2">Sobre Nosotros</p>
                            </div>
                        </a>
                    </div>
                    <div class="nav__item">
                        <a href="/pages/museos.php">
                            <div class="item__icon">
                                <img src="../img/icons/museum.svg" alt="Icono Museos" title="Museos">
                                <p id="nav3">Museos</p>
                            </div>
                        </a>
                    </div>
                </li>
            </ul>
        </nav>
        <div class="header__black-screen"></div>
    </header>