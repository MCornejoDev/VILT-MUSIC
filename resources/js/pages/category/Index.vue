<script setup lang="ts">
import { useI18n } from 'vue-i18n';
import { Head } from '@inertiajs/vue3';
import AppLayout from '@/layouts/AppLayout.vue';

import {
  Card,
  CardHeader,
  CardTitle,
  CardContent,
} from '@/components/ui/card';

import Pagination from '@/pages/Pagination.vue';

import { type BreadcrumbItem } from '@/types';
import { Category } from '@/types/models/category';
import { Paginated } from '@/types/models/paginated';

const { t } = useI18n();

const breadcrumbs: BreadcrumbItem[] = [
  {
    title: t('category.title'),
    href: '/categories',
  },
];

const { categories } = defineProps<{ categories: Paginated<Category> }>();
</script>

<template>
  <Head :title="t('category.title')" ></Head>

  <AppLayout :breadcrumbs="breadcrumbs">
    <div class="flex flex-col flex-1 h-full gap-4 p-4">
      <div class="grid grid-cols-1 gap-4 sm:grid-cols-2 lg:grid-cols-3">
        <Card v-for="category in categories.data" :key="category.id" class="shadow-md">
          <CardHeader>
            <CardTitle>{{ category.name }}</CardTitle>
          </CardHeader>
          <CardContent>
            <p class="text-sm text-muted-foreground">{{ category.slug }}</p>
          </CardContent>
        </Card>
      </div>

      <Pagination :paginator="categories.meta" />
    </div>
  </AppLayout>
</template>
