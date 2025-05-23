<script setup lang="ts">
import { Single } from '@/types/models/single';
import { ref, onMounted, onUnmounted, computed } from 'vue';

defineExpose({ play });

const props = defineProps<{
    singles: Single[];
}>();

const audio = new Audio();
audio.volume = 0.3;

const isPlaying = ref(false);
const currentTrackIndex = ref<number | null>(null);
const mode = ref<'normal' | 'random' | 'repeat'>('normal');


const progress = ref(0);
const duration = ref(0);
let intervalId: number | null = null;

const currentSingle = computed(() =>
    currentTrackIndex.value !== null ? props.singles[currentTrackIndex.value] : null
);

function updateProgress() {
    progress.value = audio.currentTime;
    duration.value = audio.duration;
}

function clearProgressInterval() {
    if (intervalId !== null) {
        clearInterval(intervalId);
        intervalId = null;
    }
}

function play(index: number) {
    if (index < 0 || index >= props.singles.length) return;

    const isNewTrack = currentTrackIndex.value !== index;
    currentTrackIndex.value = index;

    if (isNewTrack) {
        audio.src = props.singles[index].file;
    }

    audio.play();
    isPlaying.value = true;

    clearProgressInterval();
    intervalId = window.setInterval(updateProgress, 500);
}

function pause() {
    audio.pause();
    isPlaying.value = false;
    clearProgressInterval();
}

function stop() {
    audio.pause();
    audio.currentTime = 0;
    isPlaying.value = false;
    clearProgressInterval();
}

function playRandomDifferentIndex(): void {
    if (props.singles.length <= 1) {
        play(0);
        return;
    }

    let randomIndex: number;
    do {
        randomIndex = Math.floor(Math.random() * props.singles.length);
    } while (randomIndex === currentTrackIndex.value);
    play(randomIndex);
}

function next() {
    if (props.singles.length === 0) return;

    if (mode.value === 'repeat') {
        play(currentTrackIndex.value ?? 0);
    } else if (mode.value === 'random') {
        playRandomDifferentIndex();
    } else {
        const nextIndex = ((currentTrackIndex.value ?? -1) + 1) % props.singles.length;
        play(nextIndex);
    }
}

function prev() {
    if (props.singles.length === 0) return;

    if (mode.value === 'repeat') {
        play(currentTrackIndex.value ?? 0);
    } else if (mode.value === 'random') {
        playRandomDifferentIndex();
    } else {
        const prevIndex = (currentTrackIndex.value ?? props.singles.length) - 1;
        play(prevIndex < 0 ? props.singles.length - 1 : prevIndex);
    }
}

function setMode(m: typeof mode.value) {
    mode.value = m;
}

function formatTime(seconds: number): string {
    const min = Math.floor(seconds / 60);
    const sec = Math.floor(seconds % 60);
    return `${min}:${sec < 10 ? '0' + sec : sec}`;
}

onMounted(() => {
    audio.addEventListener('ended', next);
});

onUnmounted(() => {
    audio.removeEventListener('ended', next);
    clearProgressInterval();
});
</script>


<template>
    <div class="p-4 text-white bg-gray-900 shadow rounded-xl">
        <div class="flex items-center justify-between mb-2">
            <div class="text-lg font-bold">
                {{ currentSingle?.title || 'Sin reproducción' }}
            </div>
            <div class="text-sm text-gray-400">
                {{ formatTime(progress) }} / {{ formatTime(duration) }}
            </div>
        </div>

        <progress class="w-full mb-4" :value="progress" :max="isNaN(duration) ? 0 : duration"></progress>

        <div class="flex items-center justify-center gap-4">
            <button @click="prev" class="text-2xl transition hover:text-indigo-500">⏮️</button>
            <button v-if="!isPlaying" @click="play(currentTrackIndex ?? 0)"
                class="text-2xl transition hover:text-indigo-500">▶️</button>
            <button v-else @click="pause" class="text-2xl transition hover:text-indigo-500">⏸️</button>
            <button @click="stop" class="text-2xl transition hover:text-indigo-500">⏹️</button>
            <button @click="next" class="text-2xl transition hover:text-indigo-500">⏭️</button>
        </div>

        <div class="flex justify-center gap-4 mt-4 text-sm">
            <button @click="setMode('normal')" :class="{ 'text-indigo-400': mode === 'normal' }">Normal</button>
            <button @click="setMode('random')" :class="{ 'text-indigo-400': mode === 'random' }">Random</button>
            <button @click="setMode('repeat')" :class="{ 'text-indigo-400': mode === 'repeat' }">Repeat</button>
        </div>
    </div>
</template>

<style scoped>
progress {
    height: 10px;
    appearance: none;
}

progress::-webkit-progress-bar {
    background-color: #374151;
    border-radius: 5px;
}

progress::-webkit-progress-value {
    background-color: #4f46e5;
    border-radius: 5px;
}
</style>
