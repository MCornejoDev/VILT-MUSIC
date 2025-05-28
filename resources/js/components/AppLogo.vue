<script setup lang="ts">
import AppLogoIcon from '@/components/AppLogoIcon.vue';
import { usePage } from '@inertiajs/vue3';
const { appName } = usePage().props;

interface Props {
    class?: string;
}

defineProps<Props>();
</script>

<template>
    <div
        class="flex items-center justify-center rounded-md aspect-square size-8 bg-sidebar-primary text-sidebar-primary-foreground">
        <AppLogoIcon class="text-white fill-current size-5 dark:text-black" />
    </div>
    <div class="grid flex-1 ml-1 text-sm text-left">
        <span class="mb-0.5 truncate font-semibold leading-none">{{ appName }}</span>
    </div>
</template>
