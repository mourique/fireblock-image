panel.plugin("ffeierabend/fireblock-image", {
  // https://remixicon.com
  // https://getkirby.com/docs/reference/plugins/extensions/icons
  icons: {
    'layout-row-line': '<path d="M19 11V5H5V11H19ZM19 13H5V19H19V13ZM4 3H20C20.5523 3 21 3.44772 21 4V20C21 20.5523 20.5523 21 20 21H4C3.44772 21 3 20.5523 3 20V4C3 3.44772 3.44772 3 4 3Z" fill="currentColor"></path>',
    'layout-top-line': '<path d="M21 3C21.5523 3 22 3.44772 22 4V20C22 20.5523 21.5523 21 21 21H3C2.44772 21 2 20.5523 2 20V4C2 3.44772 2.44772 3 3 3H21ZM4 10V19H20V10H4ZM4 8H20V5H4V8Z" fill="currentColor"></path>',
    'layout-bottom-line': '<path d="M21 3C21.5523 3 22 3.44772 22 4V20C22 20.5523 21.5523 21 21 21H3C2.44772 21 2 20.5523 2 20V4C2 3.44772 2.44772 3 3 3H21ZM4 16V19H20V16H4ZM4 14H20V5H4V14Z" fill="currentColor"></path>',
    'align-top': '<path d="M3 3H21V5H3V3ZM8 11V21H6V11H3L7 7L11 11H8ZM18 11V21H16V11H13L17 7L21 11H18Z" fill="currentColor"></path>',
    'align-vertically': '<path d="M3 11H21V13H3V11ZM18 18V21H16V18H13L17 14L21 18H18ZM8 18V21H6V18H3L7 14L11 18H8ZM18 6H21L17 10L13 6H16V3H18V6ZM8 6H11L7 10L3 6H6V3H8V6Z" fill="currentColor"></path>',
    'align-bottom': '<path d="M3 19H21V21H3V19ZM8 13H11L7 17L3 13H6V3H8V13ZM18 13H21L17 17L13 13H16V3H18V13Z" fill="currentColor"></path>',
    'last-to-bottom': '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"><path d="M6 2H18V4H6V2ZM16.9497 9.44975L12 4.5L7.05273 9.44727L8.46695 10.8615L11 8.32843V15.6706L8.46499 13.1356L7.05078 14.5498L12 19.5L16.9497 14.5503L15.5355 13.136L13 15.6716V8.32843L15.5355 10.864L16.9497 9.44975ZM18 20V22H6V20H18Z"></path></svg>',
  },
  blocks: {
    image: {
      computed: {
        captionMarks() {
          return this.field("caption", {marks: true}).marks;
        },
        crop() {
          return this.content.crop || false;
        },
        padding() {
          return "padding-top: " + this.content.padding_top + "; padding-right: " + this.content.padding_right + "; padding-bottom: " + this.content.padding_bottom + "; padding-left: " + this.content.padding_left || false;
        },
        src() {
          if (this.content.location === "web") {
            return this.content.src;
          }
          if (this.content.image[0]?.url) {
            return this.content.image[0].url;
          }
          return false;
        },
        ratio() {
          return this.content.ratio || false;
        }
      },
      template: `
        <k-block-figure
          :caption="content.caption"
          :caption-marks="captionMarks"
          :empty-text="$t('field.blocks.image.placeholder') + ' …'"
          :is-empty="!src"
          empty-icon="image"
          @open="open"
          @update="update"
        >
          <template v-if="src">
            <k-aspect-ratio v-if="ratio" :ratio="ratio" :cover="crop">
              <img :style="padding" :alt="content.alt" :src="src" />
            </k-aspect-ratio>
            <img

              v-else
              :style="padding"
              :alt="content.alt"
              :src="src"
              class="k-block-type-image-auto"
            />
          </template>
        </k-block-figure>
      `
    },
  }
});
