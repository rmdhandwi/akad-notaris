<script setup>
// import core api
import { computed, defineAsyncComponent, onMounted, ref } from 'vue'

// import store / composables

// import layout, components
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue'
import LoadingSpinner from '@/Components/LoadingSpinner.vue'

// lifecycle hooks
onMounted(() =>
{
})
// variables, functions
const props = defineProps({
    dataPermintaan : Object
})

const pageTitle = ref('Daftar Permintaan')

const currentTab = ref('List')

const switchComponents = (component,title) =>
{
    currentTab.value = component
    pageTitle.value = title
}

// async component
const loadComponent = componentName =>
{
    return  defineAsyncComponent({
        loader : () => import(`./${componentName}.vue`),
        loadingComponent : LoadingSpinner,
        delay : 200,
        timeout: 3000
    })
}

const currentComponent = computed(() => {
  return loadComponent(currentTab.value)
})

const componentProps = computed(() => {
    switch (currentTab.value) {

        case 'List':
        return {
            dataPermintaan : props.dataPermintaan?.map((p, i) => ({ nomor: i + 1, ...p })),
        };

        default:
        return {};
    }
})
</script>

<template>
    <AuthenticatedLayout :pageTitle="pageTitle">
        <template #pageContent>
            <!-- tabs -->
            <div class="flex gap-x-4">
                <Button @click="switchComponents('List','Daftar Permintaan')" label="Daftar Permintaan" :severity="currentTab==='List'?'primary':'secondary'" icon="pi pi-list" v-if="currentTab==='List'"/>
            </div>
            <!-- components -->
            <div class="flex flex-col mt-4">
                <component :is="currentComponent" v-bind="componentProps"/>
            </div>
        </template>
    </AuthenticatedLayout>
</template>

<style scoped>
</style>
