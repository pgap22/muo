function expoDiscoverComponent(id, name, img) {
    return `
    <div class="expo-discover">
        <div class="expo-discover__header">
            <img src="${img}" alt="" class="expo-discover__image">
            <h4 class="expo-discover__title" id="discover-${id}">${name}</h4>
        </div>
    </div>     
   `
}

export {expoDiscoverComponent}