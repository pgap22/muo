function expoComponent(imgSrc, titulo, info) {
    return `
    <div class="main__expo-container">
        <div class="main__expo-photo">
            <img src="${imgSrc}" alt="Museum Img" class="main__expo-img">
        </div>
        <div class="main__expo-description">
            <div class="main__expo-data">
                <h3 class="main__expo-title">${titulo}</h3>
                <div class="main__expo-interactions">
                    <img src="../img/icons/comment.svg" alt="comment icon" class="main__expo-icons main__expo--comment-icon">
                    <img src="../img/icons/favorite.svg" alt="comment icon" class="main__expo-icons">
                </div>
        </div>
        
        <p class="main__expo-text">${info}</p>
        
        </div>
    </div>
    `
}
export {expoComponent};