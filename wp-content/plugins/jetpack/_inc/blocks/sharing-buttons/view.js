(()=>{var t={80425:(t,e,r)=>{"object"==typeof window&&window.Jetpack_Block_Assets_Base_Url&&(r.p=window.Jetpack_Block_Assets_Base_Url)},47701:t=>{"use strict";t.exports=window.wp.domReady}},e={};function r(o){var n=e[o];if(void 0!==n)return n.exports;var s=e[o]={exports:{}};return t[o](s,s.exports,r),s.exports}r.n=t=>{var e=t&&t.__esModule?()=>t.default:()=>t;return r.d(e,{a:e}),e},r.d=(t,e)=>{for(var o in e)r.o(e,o)&&!r.o(t,o)&&Object.defineProperty(t,o,{enumerable:!0,get:e[o]})},r.g=function(){if("object"==typeof globalThis)return globalThis;try{return this||new Function("return this")()}catch(t){if("object"==typeof window)return window}}(),r.o=(t,e)=>Object.prototype.hasOwnProperty.call(t,e),(()=>{var t;r.g.importScripts&&(t=r.g.location+"");var e=r.g.document;if(!t&&e&&(e.currentScript&&(t=e.currentScript.src),!t)){var o=e.getElementsByTagName("script");o.length&&(t=o[o.length-1].src)}if(!t)throw new Error("Automatic publicPath is not supported in this browser");t=t.replace(/#.*$/,"").replace(/\?.*$/,"").replace(/\/[^\/]+$/,"/"),r.p=t+"../"})(),(()=>{"use strict";r(80425)})(),(()=>{"use strict";var t=r(47701);let e;"undefined"!=typeof window&&r.n(t)()((()=>{const t=document.getElementsByClassName("wp-block-jetpack-sharing-buttons");for(const r of t)r.addEventListener("click",(t=>{const r=t.target.closest("a"),o=r?.dataset?.service;r&&r.classList.contains(`share-${o}`)&&"mail"!==o&&(t.preventDefault(),t.stopPropagation(),"print"!==o?(e&&e.close(),e=window.open(r.getAttribute("href"),`wpcom${o}`,"menubar=1,resizable=1,width=600,height=400"),e&&e.focus()):window.print())}))}))})()})();