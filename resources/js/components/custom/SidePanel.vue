<script setup lang="ts">
import { ref } from 'vue'
import { onMounted, onUnmounted } from 'vue'

interface PanelPayload {
    title: string
    component: any
    icon: any
    params?: Record<string, any>
}

const isOpen = ref(false)
const title = ref('')
const icon = ref(null)
const component = ref(null)
const params = ref({})

function openPanel({ title: t, component: c, icon: i, params: p }: PanelPayload) {
    title.value = t
    component.value = c
    icon.value = i
    params.value = p || {}
    isOpen.value = true
}

function closePanel() {
    isOpen.value = false
}

function handleOpen(e: CustomEvent<PanelPayload>) {
    openPanel(e.detail)
}

onMounted(() => {
    window.addEventListener('open-panel', handleOpen as EventListener)
    window.addEventListener('close-panel', closePanel)
})

onUnmounted(() => {
    window.removeEventListener('open-panel', handleOpen as EventListener)
    window.removeEventListener('close-panel', closePanel)
})

function onPanelClick(event: MouseEvent) {
    event.stopPropagation()
}
</script>

<template>
    <Teleport to="body">
        <transition enter-active-class="transition-opacity duration-300 ease-out"
            leave-active-class="transition-opacity duration-200 ease-in" enter-from-class="opacity-0"
            leave-to-class="opacity-0">
            <div v-if="isOpen" class="fixed inset-0 z-50 flex">
                <!-- Backdrop con blur -->
                <div class="fixed inset-0 bg-black/60 backdrop-blur-sm" @click="closePanel" />

                <!-- Panel lateral -->
                <transition enter-active-class="transition-all duration-300 ease-out"
                    leave-active-class="transition-all duration-200 ease-in"
                    enter-from-class="translate-x-full opacity-0" leave-to-class="translate-x-full opacity-0">
                    <div class="relative z-50 w-full h-full max-w-xl ml-auto overflow-hidden border-l shadow-2xl bg-gradient-to-br from-gray-900 via-gray-800 to-black border-gray-700/50"
                        @click="onPanelClick">
                        <!-- Header -->
                        <div
                            class="relative border-b bg-gradient-to-r from-gray-800 to-gray-900 border-gray-700/80 backdrop-blur-xl">
                            <!-- Línea decorativa superior -->
                            <div
                                class="absolute top-0 left-0 right-0 h-1 bg-gradient-to-r from-blue-400 via-purple-400 to-pink-400" />

                            <div class="flex items-center justify-between p-6">
                                <div class="flex items-center gap-3">
                                    <!-- Contenedor del icono -->
                                    <div v-if="icon" class="relative">
                                        <div
                                            class="absolute inset-0 rounded-lg bg-gradient-to-r from-blue-400 to-purple-400 blur-sm opacity-30" />
                                        <div
                                            class="relative p-2 bg-gray-800 border border-gray-700 rounded-lg shadow-sm">
                                            <component :is="icon" class="w-5 h-5 text-gray-200" />
                                        </div>
                                    </div>

                                    <div>
                                        <h2 class="text-xl font-semibold tracking-tight text-gray-100">{{ title }}</h2>
                                        <div
                                            class="w-12 h-0.5 bg-gradient-to-r from-blue-400 to-purple-400 mt-1 rounded-full" />
                                    </div>
                                </div>

                                <!-- Botón cerrar -->
                                <button @click="closePanel"
                                    class="relative p-2 text-gray-400 transition-all duration-200 rounded-full group hover:text-gray-200 hover:bg-gray-700">
                                    <div
                                        class="absolute inset-0 transition-opacity duration-200 bg-red-500 rounded-full opacity-0 group-hover:opacity-20" />
                                    <svg class="w-5 h-5 transition-transform duration-200 group-hover:rotate-90"
                                        fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd"
                                            d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                                            clip-rule="evenodd" />
                                    </svg>
                                </button>
                            </div>
                        </div>

                        <!-- Contenido con scroll -->
                        <div
                            class="h-full overflow-y-auto scrollbar-thin scrollbar-thumb-gray-600 scrollbar-track-transparent hover:scrollbar-thumb-gray-500">
                            <div class="relative">
                                <!-- Gradiente superior sutil -->
                                <div
                                    class="absolute top-0 left-0 w-full h-20 pointer-events-none bg-gradient-to-b from-gray-800/50 to-transparent" />

                                <!-- Contenido dinámico -->
                                <div class="relative z-10 p-6">
                                    <component :is="component" v-bind="params" />
                                </div>

                                <!-- Espaciado inferior -->
                                <div class="h-20" />
                            </div>
                        </div>

                        <!-- Línea decorativa inferior -->
                        <div
                            class="absolute bottom-0 left-0 right-0 h-px bg-gradient-to-r from-transparent via-gray-600 to-transparent" />
                    </div>
                </transition>
            </div>
        </transition>
    </Teleport>
</template>

<style scoped>
/* Scrollbar personalizada - No disponible como clases Tailwind */
.scrollbar-thin {
    scrollbar-width: thin;
}

.scrollbar-thin::-webkit-scrollbar {
    width: 6px;
}

.scrollbar-track-transparent::-webkit-scrollbar-track {
    background: transparent;
}

.scrollbar-thumb-gray-600::-webkit-scrollbar-thumb {
    @apply bg-gray-600/50 rounded-sm;
    transition: background-color 0.2s ease;
}

.scrollbar-thumb-gray-600:hover::-webkit-scrollbar-thumb,
.hover\:scrollbar-thumb-gray-500:hover::-webkit-scrollbar-thumb {
    @apply bg-gray-500/70;
}
</style>
