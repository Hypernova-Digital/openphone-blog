const { RichText, URLInput, MediaUpload, InspectorControls, withColors, withGradients, PanelColorSettings, useBlockProps, InnerBlocks } = wp.blockEditor;
const { PanelBody, Button, SelectControl } = wp.components;
const { useSelect } = wp.data;
const { useState } = wp.element;
const { registerBlockType } = wp.blocks;
import json from "./block.json";
const name = json.name;





const buildBackgroundStyle = (gradient, backgroundColor) => {
  let backgroundStyle = "";

  if (gradient) {
    backgroundStyle += gradient;
  } else if (backgroundColor) {
    backgroundStyle += backgroundColor;
  }

  return backgroundStyle
    ? {
        backgroundImage: gradient ? backgroundStyle : "",
        backgroundColor: gradient ? "" : backgroundStyle,
      }
    : {};
};

registerBlockType(name, {
  ...json,

  edit: ({ attributes, setAttributes }) => {
    console.log("Attributes:", attributes); // debugging

    const {
      eyebrowsIcon,
      eyebrows,
      eyebrows2,
      title,
      subtitle,
      linkUrl,
      linkText,
    } = attributes;

    const gradients = useSelect((select) => {
      const settings = select("core/block-editor").getSettings();
      return settings.gradients;
    }, []);

    const containerStyle = {
      ...buildBackgroundStyle(attributes.gradient, attributes.backgroundColor),
      ...useBlockProps().style,
    };

    const onSetGradient = (slug) => {
      const selectedGradient = gradients.find((g) => g.slug === slug);
      setAttributes({
        gradient: selectedGradient ? selectedGradient.gradient : "",
      });
    };

    const onSetEyebrowsIcon = (image) => {
      setAttributes({ eyebrowsIcon: image.url });
    };

    const onSetEyebrows = (value) => {
      setAttributes({ eyebrows: value });
    };

    const onSetEyebrows2 = (value) => {
      setAttributes({ eyebrows2: value });
    };

    const onSetTitle = (value) => {
      setAttributes({ title: value });
    };

    const onSetSubtitle = (value) => {
      setAttributes({ subtitle: value });
    };

    const onSetLinkUrl = (value) => {
      setAttributes({ linkUrl: value });
    };

    const onSetLinkText = (value) => {
      setAttributes({ linkText: value });
    };

    const onUploadEyebrowsIcon = (image) => {
      onSetEyebrowsIcon(image);
    };

    const blockProps = useBlockProps();

    const [popupVisible, setPopupVisible] = useState(false);

    const openPopup = (e) => {
      e.preventDefault();
      setPopupVisible(true);
    };

    const closePopup = (e) => {
      e.preventDefault();
      setPopupVisible(false);
    };

    return (
      <div {...blockProps}>
        <InspectorControls>
          {console.log(gradients)} {/* debugging */}
          <div>
            <SelectControl
              label="Gradient"
              value={
                gradients.find((g) => g.gradient === attributes.gradient)
                  ?.slug || ""
              }
              options={[
                { value: "", label: "None" },
                ...gradients.map((g) => ({
                  value: g.slug,
                  label: g.name,
                })),
              ]}
              onChange={onSetGradient}
            />
          </div>
          {console.log("PanelColorSettings")}
          <PanelColorSettings
            title="Background Color"
            initialOpen={false}
            colorSettings={[
              {
                value: attributes.backgroundColor,
                onChange: (color) => {
                  setAttributes({ backgroundColor: color });
                  // Remove gradient when background color is selected
                  if (color) {
                    setAttributes({ gradient: "" });
                  }
                },
                label: "Background Color",
              },
            ]}
          />
        </InspectorControls>
        <div
          className="hero-container container editor"
          style={{ ...containerStyle }}
        >
          <div className="hero-content">
            <div className="hero-content-right">
              <div className="hero-eyebrows-container">
                <MediaUpload
                  onSelect={onUploadEyebrowsIcon}
                  allowedTypes={["image"]}
                  render={({ open }) => (
                    <div>
                      {!eyebrowsIcon ? (
                        <Button onClick={open} className="hero-eyebrows-icon">
                          Upload Image
                        </Button>
                      ) : (
                        <img
                          src={eyebrowsIcon}
                          onClick={open}
                          alt="Eyebrows Icon"
                          className="hero-eyebrows-icon"
                        />
                      )}
                    </div>
                  )}
                />
                <RichText
                  tagName="span"
                  className="hero-eyebrows-text"
                  value={eyebrows}
                  onChange={onSetEyebrows}
                  placeholder="Your Eyeborows Here"
                />
                <span className="hero-eyebrows-arrow">&#8250;</span>
                <RichText
                  tagName="span"
                  className="hero-eyebrows-text2"
                  value={eyebrows2}
                  onChange={onSetEyebrows2}
                  placeholder="Your Eyeborows 2 Here"
                />
              </div>

              <RichText
                tagName="h1"
                className="hero-title"
                value={title}
                onChange={onSetTitle}
                placeholder="Your Title Here"
              />
              <RichText
                tagName="span"
                className="hero-subtitle"
                value={subtitle}
                onChange={onSetSubtitle}
                placeholder="Your Subtitle Here"
              />

              <div className="hero-link-container">
                <div className="hero-link-container-1">
                  <RichText
                    tagName="a"
                    className="hero-link button"
                    value={linkText}
                    onChange={onSetLinkText}
                    placeholder="Read More"
                  />
                  <URLInput
                    className="hero-link-url"
                    value={linkUrl}
                    onChange={onSetLinkUrl}
                    __nextHasNoMarginBottom={true}
                  />
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    );
  },

  save: ({ attributes }) => {
    const {
      gradient,
      backgroundColor,
      eyebrowsIcon,
      eyebrows,
      eyebrows2,
      title,
      subtitle,
      linkUrl,
      linkText,
    } = attributes;
    const containerStyle = buildBackgroundStyle(gradient, backgroundColor);

    return (
      <section
        className="wp-block-lattice-hero-sub-product hero-container"
        style={{ ...containerStyle }}
      >
        <div className="hero-content container">
          <div className="hero-eyebrows-container">
            <img className="hero-eyebrows-icon" src={eyebrowsIcon} />
            <span className="hero-eyebrows-text">{eyebrows}</span>
            <span className="hero-eyebrows-arrow">
              <svg
                width="6"
                height="10"
                viewBox="0 0 6 10"
                fill="none"
                xmlns="http://www.w3.org/2000/svg"
              >
                <path
                  opacity="0.3"
                  d="M2 8.5L4.43934 6.06066C5.02513 5.47487 5.02513 4.52513 4.43934 3.93934L2 1.5"
                  stroke="#001F1F"
                  stroke-width="1.5"
                  stroke-linecap="square"
                />
              </svg>
            </span>
            <span className="hero-eyebrows-text2">{eyebrows2}</span>
          </div>

          <h1 className="hero-title">{title}</h1>

          <span className="hero-subtitle">{subtitle}</span>

          <div className="hero-link-container">
            <a href={linkUrl} className="hero-link button">
              {linkText}
            </a>
          </div>
        </div>
      </section>
    );
  },
});

jQuery(".test-popup-link").magnificPopup({
  type: "iframe",
});
