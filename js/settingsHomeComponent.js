function settingsHomeComponent(lang){
    return `
    <div class="header__settings">                    
        <div class="header__link">
            <img src="../img/icons/userConfig.svg" class="header__page-icon" alt="settings Icon">
            <p id="setting-user">Configurar mi perfil</p>
        </div>

        <div class="header__lang">${lang}</div>
    </div>
    `
}

export {settingsHomeComponent};