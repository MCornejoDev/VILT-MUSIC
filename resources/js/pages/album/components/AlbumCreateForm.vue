<script setup lang="ts">
import { useForm } from '@inertiajs/vue3'

const form = useForm({
    name: '',
    description: '',
})

const submit = () => {
    form.post('/albums', {
        onSuccess: () => {
            form.reset()
            window.dispatchEvent(new Event('close-panel'))
        },
    })
}
</script>

<template>
    <form @submit.prevent="submit" class="p-4 space-y-4 text-black">
        <input v-model="form.name" placeholder="Nombre del álbum" class="w-full p-2 border" />
        <textarea v-model="form.description" placeholder="Descripción" class="w-full p-2 border" />
        <button type="submit" class="px-4 py-2 text-white bg-blue-500">Crear</button>
    </form>
</template>
