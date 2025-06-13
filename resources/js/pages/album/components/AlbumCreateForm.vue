<script setup lang="ts">
// 🧩 Imports externos
import { useI18n } from 'vue-i18n';
import { ref, onMounted } from 'vue';
import { router } from '@inertiajs/vue3'
import { useForm, useField } from 'vee-validate';
import * as yup from 'yup';
import axios from 'axios'; // Asegúrate de tener axios instalado con `npm i axios`
import { useToast } from '@/components/ui/toast';

// 🧩 Layouts y componentes UI
import { Button } from '@/components/ui/button';
import { Input } from '@/components/ui/input';
import { Textarea } from '@/components/ui/textarea';
import { FormField, FormItem, FormLabel, FormControl, FormMessage, } from '@/components/ui/form';
import { Select, SelectContent, SelectGroup, SelectItem, SelectLabel, SelectTrigger, SelectValue } from '@/components/ui/select';
import FileUploader from '@/components/custom/FileUploader.vue'

// 🧩 Tipos
import { Category } from '@/types/models/category';

// 🌍 Internacionalización
const { t } = useI18n();

// 📌 Props
const categories = ref<Category[]>([]);

// 🧠 Estado local
const { toast } = useToast()

// ✅ Validación con VeeValidate y Yup
const schema = yup.object({
    title: yup.string().required(t('validation.required')),
    category_id: yup
        .number()
        .typeError(t('validation.required')) // Para evitar errores si el valor es string o null
        .required(t('validation.required')),
    artist: yup.string().required(t('validation.required')),
    stocks: yup
        .number()
        .required(t('validation.required'))
        .typeError(t('validation.number'))
        .min(0, t('validation.min', { min: 0 })),
    price: yup
        .number()
        .required(t('validation.required'))
        .typeError(t('validation.number'))
        .min(0, t('validation.min', { min: 0 })),
    release_date: yup
        .string()
        .required(t('validation.required'))
        .matches(/^\d{4}-\d{2}-\d{2}$/, t('validation.date')),
    description: yup.string().required(t('validation.required')),
    cover: yup.mixed().required(t('validation.required')),
});

const { handleSubmit, resetForm } = useForm({ validationSchema: schema });

const { value: title, errorMessage: titleError, handleBlur: titleBlur } = useField<string>('title');
const { value: category_id, errorMessage: categoryError, handleChange: categoryChange, handleBlur: categoryBlur } = useField<number | ''>('category_id')
const { value: artist, errorMessage: artistError, handleBlur: artistBlur } = useField<string>('artist');
const { value: stocks, errorMessage: stocksError, handleBlur: stocksBlur } = useField<number>('stocks');
const { value: price, errorMessage: priceError, handleBlur: priceBlur } = useField<number>('price');
const { value: release_date, errorMessage: releaseDateError, handleBlur: releaseDateBlur } = useField<string>('release_date');
const { value: description, errorMessage: descriptionError, handleBlur: descriptionBlur } = useField<string>('description');
const { value: cover, errorMessage: coverError, handleBlur: coverBlur } = useField<File | undefined>('cover');


const onSubmit = handleSubmit((values) => {
    console.log(values)
    router.post('/albums', values, {
        onSuccess: (success) => {
            resetForm();
            window.dispatchEvent(new Event('close-panel'));
            const status = success.props.status;
            if (status === 'success') {
                toast({
                    title: t('album.actions.create.success.title'),
                    description: t('album.actions.create.success.description'),
                });
            } else {
                toast({
                    title: t('album.actions.create.error.title'),
                    description: t('album.actions.create.error.description'),
                });
            }
        },
        onError: (errors) => {
            console.error('Errores de validación:', errors);
            toast({
                title: t('album.actions.create.error.title'),
                description: t('album.actions.create.error.description'),
            });
        },
    });
});

onMounted(async () => {
    try {
        const response = await axios.get('/api/categories');
        categories.value = response.data;
    } catch (error) {
        console.error('Error cargando categorías:', error);
    }
});

</script>

<template>
    <form @submit.prevent="onSubmit" class="space-y-4">
        <!-- Name -->
        <FormField v-slot="{ componentField }" name="title">
            <FormItem>
                <FormLabel>{{ t('album.form.title') }}</FormLabel>
                <FormControl>
                    <Input v-bind="componentField" v-model="title" @blur="titleBlur"
                        :placeholder="t('album.form.placeholder.title')" />
                </FormControl>
                <FormMessage>{{ titleError }}</FormMessage>
            </FormItem>
        </FormField>

        <!-- Artist -->
        <FormField v-slot="{ componentField }" name="artist">
            <FormItem>
                <FormLabel>{{ t('album.form.artist') }}</FormLabel>
                <FormControl>
                    <Input v-bind="componentField" v-model="artist" @blur="artistBlur"
                        :placeholder="t('album.form.placeholder.artist')" />
                </FormControl>
                <FormMessage>{{ artistError }}</FormMessage>
            </FormItem>
        </FormField>

        <div class="grid grid-cols-1 gap-4 md:grid-cols-2">
            <!-- Category -->
            <FormField name="category">
                <FormItem>
                    <FormLabel>{{ t('album.form.category') }}</FormLabel>
                    <FormControl>
                        <Select :modelValue="category_id" @update:modelValue="categoryChange" @blur="categoryBlur">
                            <SelectTrigger
                                class="w-full h-10 text-sm border rounded-md shadow-sm bg-background border-input">
                                <SelectValue :placeholder="t('album.form.placeholder.category')" />
                            </SelectTrigger>
                            <SelectContent>
                                <SelectGroup>
                                    <SelectLabel>{{ t('album.form.placeholder.category') }}</SelectLabel>
                                    <SelectItem v-for="c in categories" :key="c.id" :value="c.id"
                                        class="cursor-pointer">
                                        {{ c.name }}
                                    </SelectItem>
                                </SelectGroup>
                            </SelectContent>
                        </Select>
                    </FormControl>
                    <FormMessage>{{ categoryError }}</FormMessage>
                </FormItem>
            </FormField>

            <!-- Stocks -->
            <FormField v-slot="{ componentField }" name="stocks">
                <FormItem>
                    <FormLabel>{{ t('album.form.stocks') }}</FormLabel>
                    <FormControl>
                        <Input type="number" v-bind="componentField" v-model="stocks" @blur="stocksBlur"
                            :placeholder="t('album.form.placeholder.stocks')" />
                    </FormControl>
                    <FormMessage>{{ stocksError }}</FormMessage>
                </FormItem>
            </FormField>
        </div>

        <div class="grid grid-cols-1 gap-4 md:grid-cols-2">
            <!-- Price -->
            <FormField v-slot="{ componentField }" name="price">
                <FormItem>
                    <FormLabel>{{ t('album.form.price') }}</FormLabel>
                    <FormControl>
                        <Input type="number" step="0.01" v-bind="componentField" v-model="price" @blur="priceBlur"
                            :placeholder="t('album.form.placeholder.price')" />
                    </FormControl>
                    <FormMessage>{{ priceError }}</FormMessage>
                </FormItem>
            </FormField>

            <!-- Release Date -->
            <FormField v-slot="{ componentField }" name="release_date">
                <FormItem>
                    <FormLabel>{{ t('album.form.release_date') }}</FormLabel>
                    <FormControl>
                        <Input type="date" v-bind="componentField" v-model="release_date" @blur="releaseDateBlur" />
                    </FormControl>
                    <FormMessage>{{ releaseDateError }}</FormMessage>
                </FormItem>
            </FormField>
        </div>

        <!-- Descripción -->
        <FormField v-slot="{ componentField }" name="description">
            <FormItem>
                <FormLabel>{{ t('album.form.description') }}</FormLabel>
                <FormControl>
                    <Textarea v-bind="componentField" v-model="description" @blur="descriptionBlur"
                        class="w-full h-10 text-sm border rounded-md shadow-sm bg-background border-input" />
                </FormControl>
                <FormMessage>{{ descriptionError }}</FormMessage>
            </FormItem>
        </FormField>

        <FormField v-slot="{ componentField }" name="cover">
            <FormItem>
                <FormLabel>{{ t('album.form.file') }}</FormLabel>
                <FormControl>
                    <FileUploader v-bind="componentField" v-model="cover" @blur="coverBlur" />
                </FormControl>
                <FormMessage>{{ coverError }}</FormMessage>
            </FormItem>
        </FormField>

        <!-- Submit -->
        <div class="flex justify-end">
            <Button type="submit">
                {{ t('category.actions.create.button') }}
            </Button>
        </div>
    </form>
</template>
