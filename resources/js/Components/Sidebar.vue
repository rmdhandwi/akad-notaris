<script setup>
import { computed } from 'vue'
import { router, usePage } from '@inertiajs/vue3'

import { adminMenu } from '@/Composables/sidebarMenu'

const menus = computed(() =>
{
    const roleId = usePage().props.auth.user?.role_id

    if(roleId === 1) return adminMenu
})

</script>

<template>
    <div class="transition-all ease-in-out duration-[450ms] rounded-lg w-[180px] h-[99vh] p-2 flex flex-col bg-gradient-to-b from-blue-500 to-blue-400 gap-[2rem] justify-between fixed">
        <div class="flex flex-col gap-4 text-lg items-center">
            <Button v-for="menu in menus" :key="menu.route" :label="menu.label" :icon="menu.icon" class="w-full p-1 flex gap-x-2 items-center" :class="{'bg-slate-100 text-sky-500 rounded' : route().current(menu.route),'text-slate-50' : !route().current(menu.route)}" @click="router.visit(route(menu.route))" unstyled/>
        </div>
    </div>
</template>
