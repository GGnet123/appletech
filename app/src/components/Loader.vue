<template>
  <div
      class="loader"
      :class="{ 'loader visible': visible }"
  >
    <span class="loader-text" :class="{ 'loader-text visible': visible }">Loading</span>
  </div>
</template>
<script>
export default {
  name: "LoaderComponent",
  props: ["visible"]
};
</script>
<style>
.loader {
  background: rgba(255, 255, 255, 0.8);
  transition: 0.15s ease-in opacity;
  position: absolute;
  pointer-events: none;
  opacity: 0;
  height: 100%;
  width: 100%;
}
.loader-text {
  position: absolute;
  top: 45%;
  left: 45%;
  font-size: 50px;
}
.visible {
  opacity: 1;
  pointer-events: all;
}
</style>