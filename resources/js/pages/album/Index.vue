<script setup lang="ts">
import { useI18n } from 'vue-i18n';
// Inicializa i18n en el componente
const { t } = useI18n();
import { Head, router } from '@inertiajs/vue3';
import AppLayout from '@/layouts/AppLayout.vue';

import { type BreadcrumbItem } from '@/types';
import { Album } from '@/types/models/album';
import { Paginated } from '@/types/models/paginated';

import {
    Table,
    TableBody,
    // TableCaption,
    TableCell,
    TableHead,
    TableHeader,
    TableRow,
} from '@/components/ui/table'
import Pagination from '@/pages/Pagination.vue';

const breadcrumbs: BreadcrumbItem[] = [
    {
        title: t('album.title'),
        href: '/albums',
    },
];

const { albums } = defineProps<{ albums: Paginated<Album> }>();

const goToAlbum = (id: number) => {
    router.visit(`/albums/${id}`);
}

</script>

<template>

    <Head title="Dashboard"></Head>
    <AppLayout :breadcrumbs="breadcrumbs">
        <div class="flex flex-col flex-1 h-full gap-4 p-4 rounded-xl">
            <Table class="w-full">
                <TableHeader>
                    <TableRow>
                        <TableHead>#</TableHead>
                        <TableHead>{{ t('album.table.title') }}</TableHead>
                        <TableHead>{{ t('album.table.category') }}</TableHead>
                        <TableHead>{{ t('album.table.artist') }}</TableHead>
                        <TableHead>{{ t('album.table.stocks') }}</TableHead>
                        <TableHead>{{ t('album.table.price') }}</TableHead>
                        <TableHead>{{ t('album.table.release_date') }}</TableHead>
                        <TableHead>{{ t('actions.title') }}</TableHead>
                    </TableRow>
                </TableHeader>
                <TableBody>
                    <TableRow v-for="album in albums.data" :key="album.id">
                        <TableCell>
                            <img :src="album.cover" class="w-10 h-10 rounded-full" />
                        </TableCell>
                        <TableCell>{{ album.title }}</TableCell>
                        <TableCell>{{ album.category.name }}</TableCell>
                        <TableCell>{{ album.artist }}</TableCell>
                        <TableCell>{{ album.stocks }}</TableCell>
                        <TableCell>{{ album.price }}</TableCell>
                        <TableCell>{{ album.release_date }}</TableCell>
                        <TableCell>
                            <a v-on:click="goToAlbum(album.id)"
                                class="text-blue-500 cursor-pointer hover:text-blue-700">See</a>
                            <span class="mx-2">|</span>
                            <a href="#" class="text-blue-500 hover:text-blue-700">Edit</a>
                            <span class="mx-2">|</span>
                            <a href="#" class="text-blue-500 hover:text-blue-700">Delete</a>
                        </TableCell>
                    </TableRow>
                </TableBody>
            </Table>
            <Pagination :paginator="albums.meta"></Pagination>
        </div>
    </AppLayout>
</template>
