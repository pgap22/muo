function menuComponent() {
    return `
    <div class="header__page-container">
        <div class="header__link settings-click">
            <img src="../img/icons/settings.svg" class="header__page-icon" alt="settings Icon">
            <p id="setting" >Configurar mi perfil</p>
        </div>

        <a href="/home" class="header__link">
            <img src="../img/icons/Home.svg" alt="" class="header__page-icon">
            <p id="home-page">Pagina principal</p>
        </a>

        <a href="/pages/nosotros.php" class="header__link">
            <img src="../img/icons/about.svg" alt="" class="header__page-icon">
            <p id="about-page">Sobre Nosotros</p>
        </a>

        <a href="/pages/museos.php" class="header__link" >
                <img src="../img/icons/museum.svg" alt="" class="header__page-icon">
                <p id="museum-page">Museos</p>
        </a>
    </div>    

    <a href="/auth/logoutUser.php">
        <div class="header__link header__link--logout">
            <img src="../img/icons/logout.svg" alt="Logout Icon" class="header__logout-icon">
            <p id="logout" class="header__logout-text">Cerrar Sesion</p>
        </div>
    </a>
    `
}
export {menuComponent};