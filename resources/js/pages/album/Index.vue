<script setup lang="ts">
import { useI18n } from 'vue-i18n';
import { ref } from 'vue';
import { useToast } from '@/components/ui/toast';
import { markRaw } from 'vue'

// Inicializa i18n en el componente
const { t } = useI18n();
import { Head, router } from '@inertiajs/vue3';
import AppLayout from '@/layouts/AppLayout.vue';

import { type BreadcrumbItem } from '@/types';
import { Album } from '@/types/models/album';
import { Paginated } from '@/types/models/paginated';

import {
    Dialog,
    DialogContent,
    DialogDescription,
    DialogHeader,
    DialogTitle,
} from '@/components/ui/dialog'
import { Button } from '@/components/ui/button'
import Toaster from '@/components/ui/toast/Toaster.vue'
import AlbumList from '@/pages/album/components/AlbumList.vue';
import AlbumCreateForm from './components/AlbumCreateForm.vue';

const breadcrumbs: BreadcrumbItem[] = [
    {
        title: t('album.title'),
        href: '/albums',
    },
];

const { albums } = defineProps<{ albums: Paginated<Album> }>();
const showDeleteModal = ref(false);
const albumToDelete = ref<number | null>(null);
const { toast } = useToast()

const openDeleteModal = (albumId: number) => {
    albumToDelete.value = albumId;
    showDeleteModal.value = true;
};

const confirmDelete = () => {
    if (albumToDelete.value !== null) {
        router.delete(`/albums/${albumToDelete.value}`, {
            onSuccess: (success) => {
                const status = success.props.status;
                if (status === 'success') {
                    toast({
                        title: t('album.actions.delete.success.title'),
                        description: t('album.actions.delete.success.description'),
                    });
                    showDeleteModal.value = false;
                    albumToDelete.value = null;
                    router.reload();
                } else {
                    toast({
                        title: t('album.actions.delete.error.title'),
                        description: t('album.actions.delete.error.description'),
                    });
                }
            },
            onError: (errors) => {
                console.error('Error al eliminar:', errors);
                toast({
                    title: t('album.actions.delete.error.title'),
                    description: t('album.actions.delete.error.description'),
                });
            },
        });
    }
};
const openPanel = () => {
    window.dispatchEvent(
        new CustomEvent('open-panel', {
            detail: {
                title: t('album.actions.create.title'),
                component: markRaw(AlbumCreateForm),
                icon: null,
                params: {},
            },
        })
    )
}
</script>

<template>

    <Head title="Dashboard"></Head>
    <AppLayout :breadcrumbs="breadcrumbs">
        <Button @click="openPanel">
            {{ t('album.actions.create.btn') }}
        </Button>
        <AlbumList :albums="albums" @request-delete="openDeleteModal" />

        <Dialog v-model:open="showDeleteModal">
            <DialogContent>
                <DialogHeader>
                    <DialogTitle>{{ t('album.actions.delete.title') }}</DialogTitle>
                    <DialogDescription>{{ t('album.actions.delete.description') }}</DialogDescription>
                </DialogHeader>
                <div class="flex justify-end gap-2 mt-4">
                    <Button variant="outline"
                        @click="showDeleteModal = false">{{ t('album.actions.delete.reject') }}</Button>
                    <Button variant="destructive" @click="confirmDelete">{{ t('album.actions.delete.accept') }}</Button>
                </div>
            </DialogContent>
        </Dialog>
        <Toaster />

    </AppLayout>
</template>
