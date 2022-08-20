import { expoRecommend } from "./expo-recommend.js";
import { expoComponent } from "./expoComponent.js";
import { getData, render } from "./getData.js";

console.log("Importado !");

globalThis.expoRecommend = expoRecommend;
globalThis.expoComponent = expoComponent;
globalThis.getData = getData;
globalThis.render = render;