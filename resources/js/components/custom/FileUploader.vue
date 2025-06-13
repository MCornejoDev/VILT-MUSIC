<script setup lang="ts">
import vueFilePond from 'vue-filepond'
import { ref, watch } from 'vue'
import FilePondPluginImagePreview from 'filepond-plugin-image-preview'
import 'filepond/dist/filepond.min.css'
import 'filepond-plugin-image-preview/dist/filepond-plugin-image-preview.min.css'

// Plugin + component
const FilePond = vueFilePond(FilePondPluginImagePreview)

const emit = defineEmits(['update:modelValue'])
const props = defineProps({
    modelValue: File,
    name: String,
})

const files = ref([])

watch(files, (newFiles) => {
    emit('update:modelValue', newFiles[0]?.file || '')
})
</script>

<template>
    <FilePond name="file" label-idle="Arrastra tu imagen o <span class='filepond--label-action'>explora</span>"
        accepted-file-types="image/*" allow-image-preview allow-file-size-validation max-file-size="5MB" :files="files"
        @update:files="files = $event" />
</template>
