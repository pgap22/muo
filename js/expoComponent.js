function expoComponent(imgSrc, titulo, info, id, fav) {
    let img = '';
    
    if(fav){
        img = "/img/icons/favAdded.svg";
    }
    else{
        img = "/img/icons/favorite.svg";
    }
    return `
        <div class="main__expo-container">
            <div class="main__expo-photo">
                <a href="/home/expo.php?id=${id}">
                    <img src="${imgSrc}" alt="Museum Img" class="main__expo-img">
                </a>
            </div>
            <div class="main__expo-description">
                <div class="main__expo-data">
                    <h3 class="main__expo-title" id="name-${id}">${titulo}</h3>
                    <div class="main__expo-interactions" onclick="addFav(${id}, this)">
                        <img src="${img}" alt="Favorite icon" class="main__expo-icons">                                       
                    </div>
            </div>
            
            <p class="main__expo-text" id="info-${id}">${info}</p>
            
            </div>
        </div>

    `
}
export {expoComponent};