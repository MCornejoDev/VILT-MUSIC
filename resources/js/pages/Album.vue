<script setup lang="ts">
import AppLayout from '@/layouts/AppLayout.vue';
import { type BreadcrumbItem } from '@/types';
import { Head } from '@inertiajs/vue3';
import {
  Table,
  TableBody,
  TableCaption,
  TableCell,
  TableHead,
  TableHeader,
  TableRow,
} from '@/components/ui/table'
import { Album } from '@/types/album';

const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'Albums',
        href: '/albums',
    },
];

defineProps<{
    name?: string;
    albums: Album[]
}>();




</script>

<template>
    <Head title="Dashboard" />
    <AppLayout :breadcrumbs="breadcrumbs">
        <div class="flex flex-col flex-1 h-full gap-4 p-4 rounded-xl">
            <Table class="w-full">
                <TableHeader>
                <TableRow>
                    <TableHead>#</TableHead>
                    <TableHead>Title</TableHead>
                    <TableHead>Category</TableHead>
                    <TableHead>Artist</TableHead>
                    <TableHead>Stocks</TableHead>
                    <TableHead>Price</TableHead>
                    <TableHead>Release Date</TableHead>
                    <TableHead>Actions</TableHead>
                </TableRow>
                </TableHeader>
                <TableBody>
                <TableRow v-for="album in albums" :key="album.id">
                    <TableCell>
                        <img :src="album.cover" class="w-10 h-10 rounded-full" />
                    </TableCell>
                    <TableCell>{{ album.title }}</TableCell>
                    <TableCell>{{ album.category_id }}</TableCell>
                    <TableCell>{{ album.artist }}</TableCell>
                    <TableCell>{{ album.stocks }}</TableCell>
                    <TableCell>{{ album.price }}</TableCell>
                    <TableCell>{{ album.release_date }}</TableCell>
                    <TableCell>
                        <a href="#" class="text-blue-500 hover:text-blue-700">Edit</a>
                        <span class="mx-2">|</span>
                        <a href="#" class="text-blue-500 hover:text-blue-700">Delete</a>
                    </TableCell>
                </TableRow>
                </TableBody>
            </Table>
        </div>
    </AppLayout>
</template>
