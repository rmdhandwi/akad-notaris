<script setup>
// import core api
import { computed } from 'vue'
import { router, usePage } from '@inertiajs/vue3'
import { useConfirm } from 'primevue'

// import store / composables
import { adminMenu, notarisMenu, klienMenu } from '@/Composables/sidebarMenu'
import { useNotification } from '@/Composables/useNotification'

// variables, functions
const confirm = useConfirm()

const { showToast } = useNotification()

const menus = computed(() =>
{
    const roleId = usePage().props.auth.user?.role_id

    if(roleId === 1) return adminMenu
    if(roleId === 3) return notarisMenu
    if(roleId === 4) return klienMenu
})

const confirmLogout = () =>
{
    confirm.require({
        message: 'Yakin ingin logout dari aplikasi?',
        header: 'Peringatan',
        icon: 'pi pi-exclamation-triangle',
        rejectProps: {
            label: 'Batal',
            severity: 'secondary',
            outlined: true
        },
        acceptProps: {
            label: 'Logout',
            severity: 'danger'
        },
        accept : () => {
            showToast(
                'Proses Logout',
                'info',
            ),
            setTimeout(() =>
                router.get(route('user.logout'))
            ,3000)
        },
    });
}

</script>

<template>
    <div class="rounded-lg w-[200px] h-[99vh] p-2 flex flex-col bg-gradient-to-b from-blue-500 to-blue-400 gap-[2rem] justify-between fixed">
        <div class="flex flex-col gap-4 text-lg items-center">
            <Button v-for="menu in menus" :key="menu.route" :label="menu.label" :icon="menu.icon" class="w-full p-1 flex gap-x-2 items-center" :class="{'bg-slate-100 text-sky-500 rounded' : route().current(menu.route),'text-slate-50' : !route().current(menu.route)}" @click="router.visit(route(menu.route))" unstyled/>
        </div>
        <Button @click="confirmLogout()" class="w-full self-end" severity="danger" label="Logout" icon="pi pi-power-off"/>
    </div>
</template>
