<script setup lang="ts">
import { router } from '@inertiajs/vue3';
import { Eye, Pencil, Trash } from 'lucide-vue-next';
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
        <TableCell class="flex items-center justify-center gap-2 h-14">
            <Eye class="w-5 h-5 text-blue-500 cursor-pointer hover:text-blue-700" @click="goToAlbum" />
            <Pencil class="w-5 h-5 cursor-pointer text-violet-500 hover:text-violet-700" />
            <Trash class="w-5 h-5 text-red-500 cursor-pointer hover:text-red-700" @click="askDelete" />
        </TableCell>
    </TableRow>
</template>
