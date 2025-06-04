<script setup lang="ts">
import AlbumRow from '@/pages/album/components/AlbumRow.vue';
import Pagination from '@/pages/Pagination.vue';
import { Table, TableHeader, TableRow, TableHead, TableBody } from '@/components/ui/table';
import { useI18n } from 'vue-i18n';
import { Album } from '@/types/models/album';
import { Paginated } from '@/types/models/paginated';

const { albums } = defineProps<{ albums: Paginated<Album> }>();
const { t } = useI18n();

const emit = defineEmits(['request-delete']);

const handleRequestDelete = (albumId: number) => {
    emit('request-delete', albumId);
};
</script>

<template>
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
            <TableBody v-if="albums.data.length">
                <AlbumRow v-for="album in albums.data" :key="album.id" :album="album"
                    @request-delete="handleRequestDelete" />
            </TableBody>
            <TableBody v-else>
                <TableRow>
                    <TableHead :colspan="8" class="text-center text-gray-500">{{ t('album.table.no_results') }}
                    </TableHead>
                </TableRow>
            </TableBody>
        </Table>
        <Pagination v-if="albums.meta.total > albums.meta.per_page" :paginator="albums.meta" />
    </div>
</template>
