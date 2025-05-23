<script setup lang="ts">
import { router } from '@inertiajs/vue3';
import { Button } from '@/components/ui/button';
import { PaginatorMeta } from '@/types/models/paginated';

const { paginator } = defineProps<{ paginator: PaginatorMeta }>();

function goTo(url: string | null) {
    if (url) {
        router.visit(url);
    }
}
</script>

<template>
    <div class="flex items-center gap-2">
        <template v-for="(link, index) in paginator.links" :key="index">
            <Button class="min-w-[40px] h-10 px-2" :variant="link.active ? 'default' : 'outline'" :disabled="!link.url"
                @click="goTo(link.url)">
                <span v-html="link.label"></span>
            </Button>
        </template>
    </div>
</template>
