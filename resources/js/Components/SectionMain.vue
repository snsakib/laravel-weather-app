<script setup>
import { containerMaxW } from '@/config.js'
</script>

<template>
  <section
    class="px-6"
    :class="containerMaxW"
  >
    <slot />
  </section>
</template>
