<script setup lang="ts">
import { router } from '@inertiajs/vue3';
import { TableRow, TableCell } from '@/components/ui/table';
import { Album } from '@/types/models/album';

const props = defineProps<{ album: Album }>();
const emit = defineEmits(['request-delete']);

const goToAlbum = () => {
    router.visit(`/albums/${props.album.id}`);
};

const askDelete = () => {
    emit('request-delete', props.album.id);
};

</script>

<template>
    <TableRow>
        <TableCell><img :src="album.cover" class="w-10 h-10 rounded-full" /></TableCell>
        <TableCell>{{ album.title }}</TableCell>
        <TableCell>{{ album.category.name }}</TableCell>
        <TableCell>{{ album.artist }}</TableCell>
        <TableCell>{{ album.stocks }}</TableCell>
        <TableCell>{{ album.price }}</TableCell>
        <TableCell>{{ album.release_date }}</TableCell>
        <TableCell>
            <a @click="goToAlbum" class="text-blue-500 cursor-pointer hover:text-blue-700">See</a>
            <span class="mx-2">|</span>
            <a href="#" class="text-blue-500 cursor-pointer hover:text-blue-700">Edit</a>
            <span class="mx-2">|</span>
            <a @click="askDelete" class="text-blue-500 cursor-pointer hover:text-blue-700">Delete</a>
        </TableCell>
    </TableRow>
</template>
