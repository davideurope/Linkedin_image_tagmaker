<template>
  <div
    data-app="true"
    class="v-application v-application--is-ltr theme--light"
    id="inspire"
    file="wireframes/three-column"
  >
    <div class="v-application--wrap">
      <Header />
      <main
        class="v-main grey lighten-3"
        data-booted="true"
        style="padding: 35px 0px 0px"
      >
        <div class="v-main__wrap">
          <div class="container">
            <div class="row">
              <div class="col-sm-12 col-12 pa-1">
                <div
                  class="v-sheet theme--light rounded-lg"
                  style="min-height: 70vh"
                >
                  <div class="d-flex justify-center px-12">
                    <v-text-field v-model="hashtag" counter="11" maxlength="11">
                      <h1 slot="prepend" class="mb-3">#</h1>
                    </v-text-field>
                    <v-swatches
                      v-model="color"
                      class="d-flex align-center px-3"
                    ></v-swatches>
                    <div class="d-flex align-center">{{ color }}</div>
                  </div>

                  <div class="d-flex justify-center">
                    <v-btn
                      v-if="showBtn"
                      outlined
                      small
                      @click="uploadCroppedImage"
                      >DOWNLOAD IMAGE</v-btn
                    >
                    <v-btn v-else outlined small @click="restart"
                      >RESTART</v-btn
                    >
                  </div>

                  <div class="d-flex justify-center pa-3">
                    <div
                      style="position: relative; height: 350px; width: 350px"
                      id="html2img"
                    >
                      <croppa
                        id="myCroppa"
                        v-model="myCroppa"
                        :width="350"
                        :height="350"
                        placeholder="Click or Drag Image"
                        :placeholder-font-size="20"
                        :remove-button-size="30"
                        :show-remove-button="showBtn"
                        @file-type-mismatch="onFileTypeMismatch"
                        :file-size-limit="100000000"
                        @file-size-exceed="onFileSizeExceed"
                        accept="image/*"
                        initial-size="contain"
                        initial-position="center"
                        show-loading
                      ></croppa>
                      <canvas
                        ref="canvas"
                        style="
                          position: absolute;
                          top: 0;
                          left: 0;
                          height: 350px;
                          width: 350px;
                          pointer-events: none;
                        "
                      ></canvas>
                      <svg
                        id="svgText"
                        style="
                          position: absolute;
                          top: 0;
                          left: 0;
                          height: 350px;
                          width: 350px;
                          pointer-events: none;
                        "
                        xmlns="http://www.w3.org/2000/svg"
                        xmlns:xlink="http://www.w3.org/1999/xlink"
                      >
                        <defs>
                          <path
                            id="curve"
                            d="M43.2,255.9c19.9,49.3,71,71.7,126.5,78.3c31.3,3.7,60.9-3.2,77.3-23.9"
                          />
                        </defs>
                        <text
                          dominant-baseline="end"
                          text-anchor="end"
                          startOffset="150%"
                        >
                          <textPath xlink:href="#curve">
                            {{ "#" + hashtag }}
                          </textPath>
                        </text>
                      </svg>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </main>
    </div>
  </div>
</template>

<script>
import Header from "./Header.vue";
import VSwatches from "vue-swatches";
import "vue-swatches/dist/vue-swatches.css";
import * as htmlToImage from "html-to-image";
import UAParser from "ua-parser-js";

export default {
  props: ["session"],
  components: {
    Header,
    VSwatches,
  },
  data() {
    return {
      color: "#3398DB",
      hashtag: "Hashtag",
      myCroppa: {},
      rgb: [51, 152, 219],
      showBtn: true,
      parser: {},
    };
  },
  mounted() {
    this.updateCanvas();
    this.parser = new UAParser().getResult();
  },
  watch: {
    color: function (val) {
      this.updateCanvas();
    },
  },
  methods: {
    updateCanvas() {
      let canvas = this.$refs.canvas;
      canvas.width = 350;
      canvas.height = 350;
      let ctx = canvas.getContext("2d");

      let img = new Image();
      this.hexToRGB(this.color);
      img.onload = function () {
        ctx.drawImage(img, 0, 0);
        var imgData = ctx.getImageData(0, 0, canvas.width, canvas.height);
        let arr = imgData.data;
        for (let i = 0; i < arr.length; i = i + 4) {
          const e = arr[i];
          arr[i] = this.rgb[0];
          arr[i + 1] = this.rgb[1];
          arr[i + 2] = this.rgb[2];
        }
        var dst = ctx.createImageData(canvas.width, canvas.height);
        dst.data.set(arr);
        ctx.putImageData(dst, 0, 0);
      }.bind(this);      
      img.src = `${process.env.MIX_APP_URL}/images/overlay.svg`;
    },
    RGBToHex(r, g, b) {
      r = r.toString(16);
      g = g.toString(16);
      b = b.toString(16);

      if (r.length == 1) r = "0" + r;
      if (g.length == 1) g = "0" + g;
      if (b.length == 1) b = "0" + b;

      return "#" + r + g + b;
    },
    hexToRGB(h) {
      let r = 0,
        g = 0,
        b = 0;

      // 3 digits
      if (h.length == 4) {
        r = "0x" + h[1] + h[1];
        g = "0x" + h[2] + h[2];
        b = "0x" + h[3] + h[3];

        // 6 digits
      } else if (h.length == 7) {
        r = "0x" + h[1] + h[2];
        g = "0x" + h[3] + h[4];
        b = "0x" + h[5] + h[6];
      }
      this.rgb[0] = r;
      this.rgb[1] = g;
      this.rgb[2] = b;

      return;
      // return "rgb(" + +r + "," + +g + "," + +b + ")";
    },
    changeShowBtn() {
      this.showBtn = true;
      this.myCroppa.refresh();
    },
    restart() {
      this.showBtn = true;
      this.myCroppa.refresh();
    },
    uploadCroppedImage() {
      this.myCroppa.generateBlob(
        (blob) => {
          if (blob == null) {
            return alert("Please upload an image");
          }
          this.showBtn = false;
          var ex = document
            .getElementById("myCroppa")
            .getElementsByTagName("svg")[0];
          if (ex) {
            ex.remove();
          }

          var node = document.getElementById("html2img");
          htmlToImage.toJpeg(node, { quality: 0.95 }).then(function (dataUrl) {
            var link = document.createElement("a");
            link.download = "TagMkr.jpeg";
            link.href = dataUrl;
            link.click();
          });

          axios.post("/download-image", {
            hashtag: this.hashtag,
            parser: this.parser,
            session: this.session,
          })
            .then( () => {}).catch( (err) => {});
            
          return;
        },
        "image/png",
        0.8
      );
    },
    onFileTypeMismatch(file) {
      this.snackbarError = true;
      this.error = "Incorrect File Type";
    },
    onFileSizeExceed(file) {
      this.snackbarError = true;
      this.error = "Image Size Too Big";
    },
  },
};
</script>

<style>
#overlay {
  display: none;
}

#curve {
  fill: none;
  stroke: black;
  stroke-width: 1px;
}

.st0 {
  display: none;
}
.st1 {
  filter: url(#Adobe_OpacityMaskFilter);
}
.st2 {
  fill: url(#SVGID_2_);
}
.st3 {
  fill: #ffffff;
}
.st4 {
  fill: url(#SVGID_3_);
}
.st5 {
  mask: url(#SVGID_1_);
  fill: #00aeef;
}

text {
  font-size: 30px;
  font-family: Franklin Gothic, sans-serif;
  font-weight: 600;
  text-transform: uppercase;
  letter-spacing: 3px;
  text-anchor: start;
  fill: #ffffff;
  text-anchor: start;
}
</style>