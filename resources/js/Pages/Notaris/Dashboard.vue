<script setup>
// import core api

// import layouts
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue'

// variables, functions
const pageTitle = 'Dashboard'

</script>

<template>
    <AuthenticatedLayout :pageTitle="pageTitle">
        <template #pageContent>
            <span class="text-2xl">Hello Notaris</span>
        </template>
    </AuthenticatedLayout>
</template>
