function expoRecommend(imgSrc, expoTitle, expoInfo) {
    return `
    <div class="recommend">
        <div class="recommend__header">
            <img src="${imgSrc}" alt="" class="recommend__image">
            <h4 class="recommend__title">${expoTitle}</h4>
        </div>
        <p class="recommend__text">${expoInfo}</p>
    </div>
    `
}
export {expoRecommend};