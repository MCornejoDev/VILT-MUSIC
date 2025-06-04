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
        <transition name="slide">
            <div v-if="isOpen" class="fixed inset-0 z-50 flex">
                <!-- Fondo: negro semi-transparente -->
                <div class="fixed inset-0 bg-gray-900 bg-opacity-70" @click="closePanel"></div>

                <!-- Panel lateral: fondo claro para contraste -->
                <div class="relative z-50 w-full h-full max-w-xl ml-auto overflow-y-auto bg-white shadow-lg"
                    @click="onPanelClick">
                    <div class="flex items-center justify-between p-4 border-b border-gray-200">
                        <div class="flex items-center gap-2">
                            <component :is="icon" v-if="icon" class="w-5 h-5 text-gray-700" />
                            <h2 class="text-lg font-medium text-gray-900">{{ title }}</h2>
                        </div>
                        <button @click="closePanel" class="text-gray-700 hover:text-gray-900">✕</button>
                    </div>

                    <!-- Contenido dinámico -->
                    <component :is="component" v-bind="params" />
                </div>
            </div>
        </transition>
    </Teleport>
</template>

<style scoped>
.slide-enter-active,
.slide-leave-active {
    transition: transform 0.3s ease;
}

.slide-enter-from,
.slide-leave-to {
    transform: translateX(100%);
}
</style>
