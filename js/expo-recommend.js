function expoRecommend(imgSrc, expoTitle, expoInfo, id) {
    return `
    <div class="recommend">
        <div class="recommend__header">
            <img src="${imgSrc}" alt="" class="recommend__image">
            <h4 class="recommend__title" id="recommend-title-${id}">${expoTitle.replaceAll("\\", "")}</h4>
        </div>
        <p class="recommend__text"  id="recommend-${id}">${expoInfo.replaceAll("\\", "")}</p>
    </div>
    `
}
export {expoRecommend};