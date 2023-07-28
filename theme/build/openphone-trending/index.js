(()=>{"use strict";const e=window.wp.element,t=window.wp.blocks,a=JSON.parse('{"apiVersion":2,"name":"openphone/trending","title":"Trending","icon":"megaphone","category":"common","editorScript":"file:./index.js","attributes":{"title":{"type":"string","source":"html","selector":"h2"},"cards":{"type":"array","default":[],"items":{"type":"object","properties":{"img":{"type":"string"},"text":{"type":"string"},"link":{"type":"string"}}}},"tags":{"type":"array","default":[],"items":{"type":"string"}}}}'),n=window.wp.blockEditor,l=window.wp.components,{name:r,...i}=a;(0,t.registerBlockType)(r,{...i,edit:t=>{const{attributes:a,setAttributes:r}=t,{title:i,cards:c,tags:s}=a,o=(0,n.useBlockProps)(),m=(e,t,a)=>{const n=[...c];n[e][t]=a,r({cards:n})},g=(e,t,a)=>{const n=[...s];n[e]={...n[e],[t]:a},r({tags:n})};return(0,e.createElement)("div",{...o},(0,e.createElement)(l.TextControl,{label:"Heading Text",value:i,onChange:e=>{r({title:e})}}),c.map(((t,a)=>(0,e.createElement)(e.Fragment,{key:a},(0,e.createElement)(n.MediaUpload,{onSelect:e=>m(a,"img",e.url),type:"image",value:t.img,render:({open:t})=>(0,e.createElement)(l.Button,{onClick:t},"Upload Image")}),(0,e.createElement)(n.RichText,{tagName:"h4",onChange:e=>m(a,"text",e),value:t.text}),(0,e.createElement)(n.URLInput,{value:t.link,onChange:e=>m(a,"link",e)})))),(0,e.createElement)(l.Button,{onClick:()=>{const e=[...c,{img:"",text:"",link:""}];r({cards:e})}},"Add Card"),s.map(((t,a)=>(0,e.createElement)(e.Fragment,{key:a},(0,e.createElement)(l.TextControl,{label:"Tag",value:t.text,onChange:e=>g(a,"text",e)}),(0,e.createElement)(n.URLInput,{label:"Tag Link",value:t.tagLink,onChange:e=>g(a,"tagLink",e)})))),(0,e.createElement)(l.Button,{onClick:()=>{const e=[...s,{text:"",tagLink:""}];r({tags:e})}},"Add Tag"))},save:({attributes:t})=>{const{title:a,cards:n,tags:l}=t;return(0,e.createElement)("div",{className:"trending-block w-full bg-[#190E3D] text-white"},(0,e.createElement)("div",{className:"container mx-auto px-6 xl:w-[1200px]"},(0,e.createElement)("h2",{className:"text-center"},a),(0,e.createElement)("div",{className:"trending-block-cards"},n.map(((t,a)=>(0,e.createElement)("a",{href:t.link,className:"trending-block-link"},(0,e.createElement)("div",{key:a,className:"trending-block-card"},(0,e.createElement)("img",{src:t.img,alt:t.text}),(0,e.createElement)("h4",null,t.text)))))),(0,e.createElement)("div",{className:"trending-block-tags"},(0,e.createElement)("span",{className:"tag-title"},"All topics:"),(0,e.createElement)("div",{className:"tags"},l.map(((t,a)=>(0,e.createElement)("a",{key:a,href:t.tagLink,className:"tag visited:text-whtie text-white no-underline hover:text-white"},t.text)))))))}})})();