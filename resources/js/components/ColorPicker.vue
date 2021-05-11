<template>
  <v-color-picker
    class="ma-2"
    show-swatches
    swatches-max-height="300px"
    :hide-inputs="true"
    :hide-mode-switch="true"
    :hide-sliders="true"
    v-model="color"
    :update-color="updateColor"
  ></v-color-picker>
</template>

<script>
export default {
  data() {
    return {
      color: "rgb(33, 150, 243)",
    };
  },
  methods: {
      updateColor() {
          this.$emit('colorUpdated', this.color)
      }
  }
};
</script>

<style>
</style>