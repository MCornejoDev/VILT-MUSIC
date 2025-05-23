<script setup lang="ts">
import { Head } from '@inertiajs/vue3';
import AppLayout from '@/layouts/AppLayout.vue';
import { type BreadcrumbItem } from '@/types';
import { Album } from '@/types/models/album';


const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'Albums',
        href: '/albums/{album.id}',
    },
];

const { album } = defineProps<{ album: Album }>();


</script>

<template>

    <Head title="Dashboard"></Head>
    <AppLayout :breadcrumbs="breadcrumbs">
        <div class="flex flex-col flex-1 h-full gap-4 p-4 rounded-xl">
            {{ album }}
        </div>
    </AppLayout>
</template>
