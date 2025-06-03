<script setup lang="ts">
// 🧩 Imports externos
import { ref } from 'vue';
import { useI18n } from 'vue-i18n';
import { Head } from '@inertiajs/vue3';
import { useForm, useField } from 'vee-validate';
import * as yup from 'yup';
import { router } from '@inertiajs/vue3'
import { useToast } from '@/components/ui/toast';

// 🧩 Layouts y componentes UI
import AppLayout from '@/layouts/AppLayout.vue';
import Pagination from '@/pages/Pagination.vue';
import { Button } from '@/components/ui/button';
import { Input } from '@/components/ui/input';
import { Card, CardHeader, CardTitle, CardContent } from '@/components/ui/card';
import { Dialog, DialogContent, DialogHeader, DialogDescription, DialogTitle } from '@/components/ui/dialog';
import { FormField, FormItem, FormLabel, FormControl, FormMessage, } from '@/components/ui/form';
import Toaster from '@/components/ui/toast/Toaster.vue'

// 🧩 Tipos
import { type BreadcrumbItem } from '@/types';
import { Category } from '@/types/models/category';
import { Paginated } from '@/types/models/paginated';

// 🌍 Internacionalización
const { t } = useI18n();

// 📌 Props
const { categories } = defineProps<{ categories: Paginated<Category> }>();

// 🧠 Estado local
const showModal = ref(false);
const { toast } = useToast()

// ✅ Validación con VeeValidate y Yup
const schema = yup.object({
    name: yup.string().required(t('validation.required')),
});

const { handleSubmit } = useForm({ validationSchema: schema });
const { value: name, errorMessage, handleBlur } = useField<string>('name');

const onSubmit = handleSubmit((values) => {
    router.post('/categories', values, {
        onSuccess: (success) => {
            const status = success.props.status;
            console.log('status', status);

            if (status === 'success') {
                toast({
                    title: t('category.actions.create.success.title'),
                    description: t('category.actions.create.success.description'),
                });
                showModal.value = false;
            } else {
                toast({
                    title: t('category.actions.create.error.title'),
                    description: t('category.actions.create.error.description'),
                });
            }
        },
        onError: (errors) => {
            console.error('Errores de validación:', errors);
            toast({
                title: t('category.actions.create.error.title'),
                description: t('category.actions.create.error.description'),
            });
        },
    });
});

// 🧭 Breadcrumbs
const breadcrumbs: BreadcrumbItem[] = [
    {
        title: t('category.title'),
        href: '/categories',
    },
];
</script>

<template>

    <Head :title="t('category.title')" />

    <AppLayout :breadcrumbs="breadcrumbs">
        <div class="flex flex-col flex-1 h-full gap-4 p-4">
            <!-- Botón para abrir el modal -->
            <div class="flex justify-end">
                <Button @click="showModal = true">
                    {{ t('category.actions.create.title') }}
                </Button>
            </div>

            <!-- Tarjetas de categorías -->
            <div class="grid grid-cols-1 gap-4 sm:grid-cols-2 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4">
                <Card v-for="category in categories.data" :key="category.id" class="shadow-md">
                    <CardHeader>
                        <CardTitle>{{ category.name }}</CardTitle>
                    </CardHeader>
                    <CardContent>
                        <p class="text-sm text-muted-foreground">{{ category.slug }}</p>
                    </CardContent>
                </Card>
            </div>

            <!-- Paginación -->
            <Pagination :paginator="categories.meta" />
        </div>

        <!-- Modal con formulario VeeValidate -->
        <Dialog v-model:open="showModal">
            <DialogContent>
                <DialogHeader>
                    <DialogTitle>{{ t('category.actions.create.title') }}</DialogTitle>
                    <DialogDescription>
                        {{ t('category.form.description') }}
                    </DialogDescription>
                </DialogHeader>

                <form @submit.prevent="onSubmit" class="space-y-4">
                    <FormField v-slot="{ componentField }" name="name">
                        <FormItem>
                            <FormLabel>{{ t('category.form.name') }}</FormLabel>
                            <FormControl>
                                <Input v-bind="componentField" v-model="name" @blur="handleBlur"
                                    :placeholder="t('category.form.placeholder.name')" />
                            </FormControl>
                            <FormMessage>{{ errorMessage }}</FormMessage>
                        </FormItem>
                    </FormField>

                    <div class="flex justify-end">
                        <Button type="submit">
                            {{ t('category.actions.create.button') }}
                        </Button>
                    </div>
                </form>
            </DialogContent>
        </Dialog>
        <Toaster />
    </AppLayout>
</template>
