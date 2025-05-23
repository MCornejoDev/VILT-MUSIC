<script setup lang="ts">
import { useI18n } from 'vue-i18n';
// Inicializa i18n en el componente
const { t } = useI18n();

import { Head } from '@inertiajs/vue3';
import AppLayout from '@/layouts/AppLayout.vue';
import AudioPlayer from '@/components/AudioPlayer.vue';
import { type BreadcrumbItem } from '@/types';
import { Album } from '@/types/models/album';
import { Paginated } from '@/types/models/paginated';
import { Single } from '@/types/models/single';
import { ref } from 'vue';

const { album, singles } = defineProps<{ album: Album, singles: Paginated<Single> }>();
const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'Albums',
        href: '/albums',
    },
    {
        title: 'Album Detail',
        href: `/albums/${album.id}`,
    },
];
const playerRef = ref<InstanceType<typeof AudioPlayer> | null>(null);

</script>

<template>

    <Head :title="album.title"></Head>

    <AppLayout :breadcrumbs="breadcrumbs">
        <div class="flex flex-col gap-8 p-6 shadow lg:flex-row rounded-xl">
            <!-- Cover and basic info -->
            <div class="flex-shrink-0 w-full lg:w-1/3">
                <img :src="album.cover" alt="Album Cover" class="object-cover w-full rounded-xl">
            </div>

            <div class="flex flex-col flex-1 space-y-4">
                <div>
                    <h1 class="text-3xl font-bold">{{ album.title }}</h1>
                    <p class="text-lg text-gray-500">{{ album.artist }}</p>
                    <p class="text-sm text-gray-400">{{ t('album.release_date') }} {{ album.release_date }}</p>
                </div>

                <p class="text-gray-700">{{ album.description }}</p>

                <div class="flex gap-4 mt-4 text-sm text-gray-600">
                    <div><strong>{{ t('album.stocks') }}:</strong> {{ album.stocks }}</div>
                    <div><strong>{{ t('album.price') }}:</strong> ${{ album.price }}</div>
                </div>

                <div class="mt-6">
                    <h2 class="mb-2 text-xl font-semibold">{{ t('album.tracklist') }}</h2>
                    <div class="divide-y divide-gray-200 rounded-lg">
                        <div v-for="(single, index) in singles.data" :key="single.id"
                            class="flex items-center justify-between px-4 py-3 transition"
                            @click="playerRef?.play(index)">
                            <div class="flex items-center gap-4">
                                <span class="w-6 text-gray-500">{{ index + 1 }}</span>
                                <span class="font-medium">{{ single.title }}</span>
                            </div>
                            <span class="text-sm text-gray-500">{{ single.duration }} min</span>
                        </div>
                    </div>
                </div>
                <AudioPlayer ref="playerRef" :singles="singles.data"></AudioPlayer>

            </div>
        </div>
    </AppLayout>
</template>
