<script setup>
// import core api
import { onMounted, watch } from 'vue'
import { Head, usePage } from '@inertiajs/vue3'

// import composables/stores
import { useNotification } from '@/Composables/useNotification'

// import custom components
import Sidebar from '@/Components/Sidebar.vue'

// lifecycle hooks
onMounted(() =>
{
    // catch notification data
    const notification = page.props.flash
    if (notification.notif_status) {
        showToast(notification.notif_message, notification.notif_status, notification.notif_duration)
    }
})

// variables, functions
const props = defineProps({
    pageTitle : String,
    sidebarDisabled : Boolean,
})

const page = usePage()

const { showToast } = useNotification()

watch(() => page.props.flash, (newNotification) => {
  if (newNotification.notif_status) {
    showToast(newNotification.notif_message, newNotification.notif_status, newNotification.notif_duration)
  }
})
</script>

<template>
    <Toast position="bottom-right" group="br"/>

    <ConfirmDialog class="min-w-[24rem]" />

    <Head :title="props.pageTitle"/>

    <!-- #main layout -->
    <div class="bg-slate-200 flex p-1 min-h-screen overflow-hidden">
        <!-- #sidebar -->
        <Sidebar :sidebarDisabled="props.sidebarDisabled"/>

        <div class="w-full h-full px-1 overflow-hidden">
            <!-- #page content -->
            <div class="ml-[200px] h-full flex flex-col gap-2 px-1 overflow-hidden">
                <!-- #header -->
                <div  class="bg-slate-50 rounded-lg flex justify-between items-center gap-x-2 py-2 px-4 shadow-lg z-10">
                    <h1 class="text-[1.3rem] uppercase">
                        {{ props.pageTitle }}
                    </h1>
                    <span class="text-[1.3rem] uppercase">{{ page.props.auth.user.username }}</span>
                </div>
                <!-- #body -->
                <div class="bg-slate-50 rounded-lg p-4 min-h-screen">
                    <slot name="pageContent"/>
                </div>
                <!-- body selesai -->
            </div>
        </div>
    </div>
</template>

<style scoped>
</style>
