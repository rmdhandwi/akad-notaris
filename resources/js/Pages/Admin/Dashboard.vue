<script setup>
// import core api
import { Head } from '@inertiajs/vue3'

// import layouts
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue'

// variables, functions
const pageTitle = 'Dashboard'

</script>

<template>
    <Head :title="pageTitle"/>
    <AuthenticatedLayout :pageTitle="pageTitle">
        <template #pageContent>
            <span class="text-2xl">Hello Admin</span>
        </template>
    </AuthenticatedLayout>
</template>
