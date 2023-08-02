(()=>{"use strict";const e=window.wp.element,t=(window.wp.data,window.wp.blocks),l=JSON.parse('{"apiVersion":2,"name":"openphone/email-signup","title":"Email Signup","icon":"megaphone","category":"common","editorScript":"file:./index.js","attributes":{"textField":{"type":"string","source":"attribute","selector":"placeholder","default":"Your email"},"subscribeText":{"type":"string","source":"html","selector":"span","default":"Subscribe to our newsletter to keep in touch with monthly updates"},"headingText":{"type":"string","source":"html","selector":"h2","default":"Keep hanging on the line"},"buttonText":{"type":"string","source":"attribute","selector":"button","attribute":"value","default":"Subscribe"}}}'),a=window.wp.components,n=window.wp.blockEditor,{name:r,...o}=l;(0,t.registerBlockType)(r,{...o,edit:t=>{const{attributes:l,setAttributes:r}=t,o=(0,n.useBlockProps)(),i=e=>{r({content:e})};return(0,e.createElement)("div",{...o},(0,e.createElement)(a.TextControl,{label:"Heading Text",value:l.headingText,onChange:e=>{r({headingText:e})}}),(0,e.createElement)(a.TextControl,{label:"Subscribe Text",value:l.subscribeText,onChange:e=>{r({subscribeText:e})}}),(0,e.createElement)(a.TextControl,{label:"Placeholder Text",value:l.content,onChange:i}),(0,e.createElement)(a.TextControl,{label:"Placeholder Text",value:l.buttonText,onChange:i}))},save:({attributes:t})=>{const l=n.useBlockProps.save({className:"openphone-email-signup mx-0 bg-purple-50 p-6",style:"max-width: 100%;"});return(0,e.createElement)("div",{...l},(0,e.createElement)("div",{className:"mx-auto max-w-7xl px-4 py-16 sm:px-6 lg:px-8 lg:py-32 flex flex-col md:flex-row items-center"},(0,e.createElement)("h2",{className:"m-0 text-3xl tracking-[-0.6px] leading-[1] font-bold text-black md:w-1/2"},t.headingText),(0,e.createElement)("div",{className:"md:w-1/2"},(0,e.createElement)("span",{className:"block mb-4 text-black opacity-70"},t.subscribeText),(0,e.createElement)("form",{className:"mt-4 flex flex-col md:flex-row"},(0,e.createElement)("input",{type:"email",id:"email",name:"email",placeholder:t.content,className:"rounded-lg border border-black bg-white placeholder:text-slate-400 w-ful",style:"border-radius: 8px;padding-top: 0.5rem;padding-bottom: 0.5rem; padding-left: 1rem; padding-right: 1rem;"}),(0,e.createElement)("button",{className:"bg-purple-900 px-8 py-4 text-white mt-4 lg:mt-0",style:"border-radius: 10px;padding-top: 0.5rem;padding-bottom: 0.5rem; padding-left: 1rem; padding-right: 1rem;"},t.buttonText)))))}})})();