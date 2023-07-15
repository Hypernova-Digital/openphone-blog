/******/ (() => { // webpackBootstrap
/******/ 	"use strict";
/******/ 	var __webpack_modules__ = ({

/***/ "@wordpress/element":
/*!*********************************!*\
  !*** external ["wp","element"] ***!
  \*********************************/
/***/ ((module) => {

module.exports = window["wp"]["element"];

/***/ }),

/***/ "./blocks/hero-sub-product/block.json":
/*!********************************************!*\
  !*** ./blocks/hero-sub-product/block.json ***!
  \********************************************/
/***/ ((module) => {

module.exports = JSON.parse('{"apiVersion":2,"name":"lattice/hero-sub-product","title":"Hero for SUB product pages & sub product pages","icon":"superhero-alt","category":"common","editorScript":"file:./index.js","attributes":{"eyebrowsIcon":{"type":"string","source":"attribute","attribute":"src","selector":".hero-eyebrows-icon","default":""},"eyebrows":{"type":"string","source":"html","selector":".hero-eyebrows-text","default":"Your Eyebrows Here"},"eyebrows2":{"type":"string","source":"html","selector":".hero-eyebrows-text2","default":"Your Eyebrows 2 Here"},"title":{"type":"string","source":"html","selector":".hero-title","default":"Your Title Here"},"subtitle":{"type":"string","source":"html","selector":".hero-subtitle","default":"Your Subtitle Here"},"imageUrl":{"type":"string","source":"attribute","attribute":"style","selector":".hero-container","default":"url(https://picsum.photos/1600/900)"},"linkUrl":{"type":"string","source":"attribute","attribute":"href","selector":".hero-link","default":""},"linkText":{"type":"string","source":"html","selector":".hero-link","default":"Read More"},"backgroundColor":{"type":"string","default":""},"gradient":{"type":"string","default":""}}}');

/***/ })

/******/ 	});
/************************************************************************/
/******/ 	// The module cache
/******/ 	var __webpack_module_cache__ = {};
/******/ 	
/******/ 	// The require function
/******/ 	function __webpack_require__(moduleId) {
/******/ 		// Check if module is in cache
/******/ 		var cachedModule = __webpack_module_cache__[moduleId];
/******/ 		if (cachedModule !== undefined) {
/******/ 			return cachedModule.exports;
/******/ 		}
/******/ 		// Create a new module (and put it into the cache)
/******/ 		var module = __webpack_module_cache__[moduleId] = {
/******/ 			// no module.id needed
/******/ 			// no module.loaded needed
/******/ 			exports: {}
/******/ 		};
/******/ 	
/******/ 		// Execute the module function
/******/ 		__webpack_modules__[moduleId](module, module.exports, __webpack_require__);
/******/ 	
/******/ 		// Return the exports of the module
/******/ 		return module.exports;
/******/ 	}
/******/ 	
/************************************************************************/
/******/ 	/* webpack/runtime/compat get default export */
/******/ 	(() => {
/******/ 		// getDefaultExport function for compatibility with non-harmony modules
/******/ 		__webpack_require__.n = (module) => {
/******/ 			var getter = module && module.__esModule ?
/******/ 				() => (module['default']) :
/******/ 				() => (module);
/******/ 			__webpack_require__.d(getter, { a: getter });
/******/ 			return getter;
/******/ 		};
/******/ 	})();
/******/ 	
/******/ 	/* webpack/runtime/define property getters */
/******/ 	(() => {
/******/ 		// define getter functions for harmony exports
/******/ 		__webpack_require__.d = (exports, definition) => {
/******/ 			for(var key in definition) {
/******/ 				if(__webpack_require__.o(definition, key) && !__webpack_require__.o(exports, key)) {
/******/ 					Object.defineProperty(exports, key, { enumerable: true, get: definition[key] });
/******/ 				}
/******/ 			}
/******/ 		};
/******/ 	})();
/******/ 	
/******/ 	/* webpack/runtime/hasOwnProperty shorthand */
/******/ 	(() => {
/******/ 		__webpack_require__.o = (obj, prop) => (Object.prototype.hasOwnProperty.call(obj, prop))
/******/ 	})();
/******/ 	
/******/ 	/* webpack/runtime/make namespace object */
/******/ 	(() => {
/******/ 		// define __esModule on exports
/******/ 		__webpack_require__.r = (exports) => {
/******/ 			if(typeof Symbol !== 'undefined' && Symbol.toStringTag) {
/******/ 				Object.defineProperty(exports, Symbol.toStringTag, { value: 'Module' });
/******/ 			}
/******/ 			Object.defineProperty(exports, '__esModule', { value: true });
/******/ 		};
/******/ 	})();
/******/ 	
/************************************************************************/
var __webpack_exports__ = {};
// This entry need to be wrapped in an IIFE because it need to be isolated against other modules in the chunk.
(() => {
/*!******************************************!*\
  !*** ./blocks/hero-sub-product/index.js ***!
  \******************************************/
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _wordpress_element__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! @wordpress/element */ "@wordpress/element");
/* harmony import */ var _wordpress_element__WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(_wordpress_element__WEBPACK_IMPORTED_MODULE_0__);
/* harmony import */ var _block_json__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./block.json */ "./blocks/hero-sub-product/block.json");

const {
  RichText,
  URLInput,
  MediaUpload,
  InspectorControls,
  withColors,
  withGradients,
  PanelColorSettings,
  useBlockProps,
  InnerBlocks
} = wp.blockEditor;
const {
  PanelBody,
  Button,
  SelectControl
} = wp.components;
const {
  useSelect
} = wp.data;
const {
  useState
} = wp.element;
const {
  registerBlockType
} = wp.blocks;

const name = _block_json__WEBPACK_IMPORTED_MODULE_1__.name;
const buildBackgroundStyle = (gradient, backgroundColor) => {
  let backgroundStyle = "";
  if (gradient) {
    backgroundStyle += gradient;
  } else if (backgroundColor) {
    backgroundStyle += backgroundColor;
  }
  return backgroundStyle ? {
    backgroundImage: gradient ? backgroundStyle : "",
    backgroundColor: gradient ? "" : backgroundStyle
  } : {};
};
registerBlockType(name, {
  ..._block_json__WEBPACK_IMPORTED_MODULE_1__,
  edit: ({
    attributes,
    setAttributes
  }) => {
    console.log("Attributes:", attributes); // debugging

    const {
      eyebrowsIcon,
      eyebrows,
      eyebrows2,
      title,
      subtitle,
      linkUrl,
      linkText
    } = attributes;
    const gradients = useSelect(select => {
      const settings = select("core/block-editor").getSettings();
      return settings.gradients;
    }, []);
    const containerStyle = {
      ...buildBackgroundStyle(attributes.gradient, attributes.backgroundColor),
      ...useBlockProps().style
    };
    const onSetGradient = slug => {
      const selectedGradient = gradients.find(g => g.slug === slug);
      setAttributes({
        gradient: selectedGradient ? selectedGradient.gradient : ""
      });
    };
    const onSetEyebrowsIcon = image => {
      setAttributes({
        eyebrowsIcon: image.url
      });
    };
    const onSetEyebrows = value => {
      setAttributes({
        eyebrows: value
      });
    };
    const onSetEyebrows2 = value => {
      setAttributes({
        eyebrows2: value
      });
    };
    const onSetTitle = value => {
      setAttributes({
        title: value
      });
    };
    const onSetSubtitle = value => {
      setAttributes({
        subtitle: value
      });
    };
    const onSetLinkUrl = value => {
      setAttributes({
        linkUrl: value
      });
    };
    const onSetLinkText = value => {
      setAttributes({
        linkText: value
      });
    };
    const onUploadEyebrowsIcon = image => {
      onSetEyebrowsIcon(image);
    };
    const blockProps = useBlockProps();
    const [popupVisible, setPopupVisible] = useState(false);
    const openPopup = e => {
      e.preventDefault();
      setPopupVisible(true);
    };
    const closePopup = e => {
      e.preventDefault();
      setPopupVisible(false);
    };
    return (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)("div", {
      ...blockProps
    }, (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)(InspectorControls, null, console.log(gradients), " ", (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)("div", null, (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)(SelectControl, {
      label: "Gradient",
      value: gradients.find(g => g.gradient === attributes.gradient)?.slug || "",
      options: [{
        value: "",
        label: "None"
      }, ...gradients.map(g => ({
        value: g.slug,
        label: g.name
      }))],
      onChange: onSetGradient
    })), console.log("PanelColorSettings"), (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)(PanelColorSettings, {
      title: "Background Color",
      initialOpen: false,
      colorSettings: [{
        value: attributes.backgroundColor,
        onChange: color => {
          setAttributes({
            backgroundColor: color
          });
          // Remove gradient when background color is selected
          if (color) {
            setAttributes({
              gradient: ""
            });
          }
        },
        label: "Background Color"
      }]
    })), (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)("div", {
      className: "hero-container container editor",
      style: {
        ...containerStyle
      }
    }, (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)("div", {
      className: "hero-content"
    }, (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)("div", {
      className: "hero-content-right"
    }, (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)("div", {
      className: "hero-eyebrows-container"
    }, (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)(MediaUpload, {
      onSelect: onUploadEyebrowsIcon,
      allowedTypes: ["image"],
      render: ({
        open
      }) => (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)("div", null, !eyebrowsIcon ? (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)(Button, {
        onClick: open,
        className: "hero-eyebrows-icon"
      }, "Upload Image") : (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)("img", {
        src: eyebrowsIcon,
        onClick: open,
        alt: "Eyebrows Icon",
        className: "hero-eyebrows-icon"
      }))
    }), (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)(RichText, {
      tagName: "span",
      className: "hero-eyebrows-text",
      value: eyebrows,
      onChange: onSetEyebrows,
      placeholder: "Your Eyeborows Here"
    }), (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)("span", {
      className: "hero-eyebrows-arrow"
    }, "\u203A"), (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)(RichText, {
      tagName: "span",
      className: "hero-eyebrows-text2",
      value: eyebrows2,
      onChange: onSetEyebrows2,
      placeholder: "Your Eyeborows 2 Here"
    })), (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)(RichText, {
      tagName: "h1",
      className: "hero-title",
      value: title,
      onChange: onSetTitle,
      placeholder: "Your Title Here"
    }), (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)(RichText, {
      tagName: "span",
      className: "hero-subtitle",
      value: subtitle,
      onChange: onSetSubtitle,
      placeholder: "Your Subtitle Here"
    }), (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)("div", {
      className: "hero-link-container"
    }, (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)("div", {
      className: "hero-link-container-1"
    }, (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)(RichText, {
      tagName: "a",
      className: "hero-link button",
      value: linkText,
      onChange: onSetLinkText,
      placeholder: "Read More"
    }), (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)(URLInput, {
      className: "hero-link-url",
      value: linkUrl,
      onChange: onSetLinkUrl,
      __nextHasNoMarginBottom: true
    })))))));
  },
  save: ({
    attributes
  }) => {
    const {
      gradient,
      backgroundColor,
      eyebrowsIcon,
      eyebrows,
      eyebrows2,
      title,
      subtitle,
      linkUrl,
      linkText
    } = attributes;
    const containerStyle = buildBackgroundStyle(gradient, backgroundColor);
    return (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)("section", {
      className: "wp-block-lattice-hero-sub-product hero-container",
      style: {
        ...containerStyle
      }
    }, (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)("div", {
      className: "hero-content container"
    }, (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)("div", {
      className: "hero-eyebrows-container"
    }, (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)("img", {
      className: "hero-eyebrows-icon",
      src: eyebrowsIcon
    }), (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)("span", {
      className: "hero-eyebrows-text"
    }, eyebrows), (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)("span", {
      className: "hero-eyebrows-arrow"
    }, (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)("svg", {
      width: "6",
      height: "10",
      viewBox: "0 0 6 10",
      fill: "none",
      xmlns: "http://www.w3.org/2000/svg"
    }, (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)("path", {
      opacity: "0.3",
      d: "M2 8.5L4.43934 6.06066C5.02513 5.47487 5.02513 4.52513 4.43934 3.93934L2 1.5",
      stroke: "#001F1F",
      "stroke-width": "1.5",
      "stroke-linecap": "square"
    }))), (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)("span", {
      className: "hero-eyebrows-text2"
    }, eyebrows2)), (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)("h1", {
      className: "hero-title"
    }, title), (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)("span", {
      className: "hero-subtitle"
    }, subtitle), (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)("div", {
      className: "hero-link-container"
    }, (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)("a", {
      href: linkUrl,
      className: "hero-link button"
    }, linkText))));
  }
});
jQuery(".test-popup-link").magnificPopup({
  type: "iframe"
});
})();

/******/ })()
;
//# sourceMappingURL=index.js.map