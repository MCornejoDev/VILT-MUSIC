<script setup lang="ts">
import type { HTMLAttributes } from 'vue';

defineOptions({
    inheritAttrs: false,
});

interface Props {
    className?: HTMLAttributes['class'];
}

defineProps<Props>();
</script>

<template>
   <img class="inline-block" :class="className" src="/storage/images/logo.webp" alt="Laravel Starter Kit" />
</template>
