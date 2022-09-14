function searchComponent() {
    return `
    <div class="search-pop__black-screen"></div>
    <div class="search-pop__container">
        <div class="search-pop">
            <img src="/img/icons/cancel.svg" alt="" class="search-pop__quit">
            <h4 class="search-pop__text">Buscar: </h4>
            <input type="search" name="expo-search" id="" class="search-pop__input">
            <input type="submit" value="Buscar" class="search-pop__send">
        </div>
    </div>
    
    `
}
function searchLoadEvent() {
    let quit = document.querySelector(".search-pop__quit");
    quit.addEventListener("click", () => {
        document.querySelector(".search-pop__container").remove();
        document.querySelector(".search-pop__black-screen").remove();
    })
}

export {searchComponent, searchLoadEvent}