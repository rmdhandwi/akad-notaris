<script setup>
// import core api
import { onMounted, watch } from 'vue'
import { usePage } from '@inertiajs/vue3'

// import composables/stores
import { useNotification } from '@/Composables/useNotification'

// lifecycle hooks
onMounted(() =>
{
    // catch notification data
    const notification = page.props.flash
    if (notification) {
        showToast(notification.notif_message, notification.notif_status, notification.notif_duration)
    }
})

// variables, functions
const page = usePage()

const { showToast } = useNotification()

watch(() => page.props.flash, (newNotification) => {
  if (newNotification) {
    showToast(newNotification.notif_message, newNotification.notif_status, newNotification.notif_duration)
  }
})
</script>

<template>
    <Toast position="bottom-right" group="br"/>
    <div class="flex justify-center items-center min-h-screen bg-slate-100">
        <div class="flex flex-col">
            <slot />
        </div>
    </div>
</template>

<style scoped>
</style>
