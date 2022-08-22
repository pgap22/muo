import { expoRecommend } from "./expo-recommend.js";
import { expoComponent } from "./expoComponent.js";
import { getData, renderExpoComponent, renderRecommendComponent } from "./getData.js";
import { english, spanish } from "./homeDictionary.js";
import { exceptionTranslate, getLangArray, langComponent, placeHolderTranslate, startLang, translateLang } from "./langComponent.js";
import { menuComponent } from "./menuComponent.js";
import { settingsHomeComponent } from "./settingsHomeComponent.js";

console.log("Importado !");

globalThis.expoRecommend = expoRecommend;
globalThis.expoComponent = expoComponent;
globalThis.getData = getData;
globalThis.renderExpoComponent = renderExpoComponent;
globalThis.renderRecommendComponent = renderRecommendComponent;
globalThis.menuComponent  = menuComponent;
globalThis.settingsHomeComponent  = settingsHomeComponent;
globalThis.langComponent = langComponent;
globalThis.startLang = startLang;
globalThis.placeHolderTranslate = placeHolderTranslate;
globalThis.exceptionTranslate = exceptionTranslate;
globalThis.translateLang = translateLang;
globalThis.getLangArray =  getLangArray;
globalThis.english = english;
globalThis.spanish = spanish;