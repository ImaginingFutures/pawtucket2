!function(e){var t={};function n(i){if(t[i])return t[i].exports;var o=t[i]={i:i,l:!1,exports:{}};return e[i].call(o.exports,o,o.exports,n),o.l=!0,o.exports}n.m=e,n.c=t,n.d=function(e,t,i){n.o(e,t)||Object.defineProperty(e,t,{enumerable:!0,get:i})},n.r=function(e){"undefined"!=typeof Symbol&&Symbol.toStringTag&&Object.defineProperty(e,Symbol.toStringTag,{value:"Module"}),Object.defineProperty(e,"__esModule",{value:!0})},n.t=function(e,t){if(1&t&&(e=n(e)),8&t)return e;if(4&t&&"object"==typeof e&&e&&e.__esModule)return e;var i=Object.create(null);if(n.r(i),Object.defineProperty(i,"default",{enumerable:!0,value:e}),2&t&&"string"!=typeof e)for(var o in e)n.d(i,o,function(t){return e[t]}.bind(null,o));return i},n.n=function(e){var t=e&&e.__esModule?function(){return e.default}:function(){return e};return n.d(t,"a",t),t},n.o=function(e,t){return Object.prototype.hasOwnProperty.call(e,t)},n.p="/build/plugins/",n(n.s=2)}({2:function(e,t,n){"use strict";function i(e){let t,n=e.label,i="object"==typeof n?n[Object.keys(n)[0]][0]:n,o=e.value;return t=Array.isArray(o)?o.map(e=>e[Object.keys(e)[0]]):"object"==typeof o?o[Object.keys(o)[0]]:o,Array.isArray(t)&&(t=t.join(", ")),{label:i,value:t}}n.r(t),n.d(t,"default",function(){return o});class o{constructor(e){this.core=e,this.toolbarIcon,this.toolbarSide="right",this.firstClick=!0,this.isVisible=!1}handleClick(){let e,t=this.core.viewerState.manifest.metadata;if(this.firstClick){(e=document.createElement("div")).id="metadataDiv",e.className="diva-modal";let n=document.createElement("h2");n.innerText="Metadata",n.id="metadataTitle";let o=document.createElement("button");o.innerHTML="&#10006",o.classList.add("close-button"),o.onclick=(()=>{e.style.display="none",this.isVisible=!1});let l=document.createElement("div");l.id="contentDiv";for(let e=0,n=t.length;e<n;e++){let n=t[e],o=document.createElement("h4");o.innerHTML=i(n).label,o.setAttribute("style","margin-bottom: 0");let a=document.createElement("p");a.innerHTML=i(n).value,a.setAttribute("style","margin-top: 0"),l.appendChild(o),l.appendChild(a)}let a=document.createElement("p"),r=document.createElement("a");r.setAttribute("target","_blank"),r.setAttribute("href",`${this.core.settings.objectData}`),r.innerHTML="IIIF Manifest",a.appendChild(r),l.appendChild(a),e.appendChild(o),e.appendChild(n),e.appendChild(l),document.body.appendChild(e),this.firstClick=!1}else e=document.getElementById("metadataDiv");this.isVisible?(e.style.display="none",this.isVisible=!1):(e.style.display="block",this.isVisible=!0);let n=0,o=0,l=0,a=0;e.onmousedown=(t=>{l=t.clientX,a=t.clientY,document.onmousemove=(t=>{n=l-t.clientX,o=a-t.clientY,l=t.clientX,a=t.clientY,e.style.top=`${e.offsetTop-o}px`,e.style.left=`${e.offsetLeft-n}px`}),document.onmouseup=(()=>{document.onmouseup=null,document.onmousemove=null})})}createIcon(){if(!this.core.viewerState.manifest.metadata)return;const e=document.createElement("div");e.classList.add("diva-metadata-icon","diva-button");let t=document.createElementNS("http://www.w3.org/2000/svg","svg");t.setAttribute("viewBox","0 0 20 20"),t.setAttribute("style","display: block; padding: 7%"),t.id=`${this.core.settings.selector}metadata-icon`;let n=document.createElementNS("http://www.w3.org/2000/svg","g");n.id=`${this.core.settings.selector}metadata-icon-glyph`,n.setAttribute("class","diva-toolbar-icon");let i=document.createElementNS("http://www.w3.org/2000/svg","path");return i.setAttribute("d","M5.379,0.681 L5.289,0.771 L5.255,0.736 C4.401,-0.118 2.98,-0.082 2.082,0.816 L1.827,1.07 C0.931,1.967 0.894,3.388 1.749,4.243 L1.783,4.277 L1.619,4.442 C0.846,5.214 0.818,6.441 1.559,7.18 L9.884,15.508 C10.626,16.248 11.851,16.22 12.626,15.447 L16.384,11.689 C17.156,10.916 17.185,9.69 16.445,8.95 L8.117,0.622 C7.377,-0.118 6.15,-0.091 5.379,0.681 L5.379,0.681 Z M4.523,5.108 C3.645,5.108 2.931,4.393 2.931,3.508 C2.931,2.627 3.645,1.911 4.523,1.911 C5.404,1.911 6.115,2.627 6.119,3.508 C6.115,4.395 5.404,5.108 4.523,5.108 L4.523,5.108 Z"),n.appendChild(i),t.appendChild(n),e.appendChild(t),e}}o.prototype.pluginName="metadata",o.prototype.isPageTool=!1,window.Diva.MetadataPlugin=o}});
//# sourceMappingURL=metadata.js.map