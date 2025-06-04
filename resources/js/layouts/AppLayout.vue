<script setup lang="ts">
import AppLayout from '@/layouts/app/AppSidebarLayout.vue';
import type { BreadcrumbItemType } from '@/types';

import SidePanel from '@/components/custom/SidePanel.vue';
import Toaster from '@/components/ui/toast/Toaster.vue';

interface Props {
    breadcrumbs?: BreadcrumbItemType[];
}

withDefaults(defineProps<Props>(), {
    breadcrumbs: () => [],
});
</script>

<template>
    <AppLayout :breadcrumbs="breadcrumbs">
        <slot />

        <SidePanel />
        <Toaster />
    </AppLayout>
</template>
