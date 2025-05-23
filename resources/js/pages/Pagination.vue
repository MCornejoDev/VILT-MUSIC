<script setup lang="ts">
import { router } from '@inertiajs/vue3';
import { Button } from '@/components/ui/button';
import { PaginatorMeta } from '@/types/models/paginated';
import { useI18n } from 'vue-i18n';

const { t } = useI18n();
const { paginator } = defineProps<{ paginator: PaginatorMeta }>();

function goTo(url: string | null) {
    if (url) {
        router.visit(url);
    }
}

function translatedLabel(label: string): string {
    if (label.includes('Previous')) return t('pagination.previous');
    if (label.includes('Next')) return t('pagination.next');
    return label;
}
</script>

<template>
    <div class="flex items-center gap-2">
        <template v-for="(link, index) in paginator.links" :key="index">
            <Button class="min-w-[40px] h-10 px-2" :variant="link.active ? 'default' : 'outline'" :disabled="!link.url"
                @click="goTo(link.url)">
                <span v-if="link.label.includes('Previous') || link.label.includes('Next')">
                    {{ translatedLabel(link.label) }}
                </span>
                <span v-else v-html="link.label" />
            </Button>
        </template>
    </div>
</template>
