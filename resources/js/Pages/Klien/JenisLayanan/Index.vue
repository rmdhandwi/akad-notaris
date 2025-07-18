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
    selectedJenis.value = null
})

// variables, functions
const props = defineProps({
    dataJenisLayanan : Object
})

const pageTitle = ref('Daftar Jenis Layanan')

const currentTab = ref('List')

const selectedJenis = ref([])

const switchComponents = (component,title, id_jenis) =>
{
    setSelectedJenis(id_jenis)
    currentTab.value = component
    pageTitle.value = title
}

const setSelectedJenis = id_jenis =>
{
    if(id_jenis)
    {
        const filterData = props.dataJenisLayanan.find(data => data.id_jenis === id_jenis)
        selectedJenis.value = filterData
    }

    else selectedJenis.value = null
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
            dataJenisLayanan : selectedJenis.value,
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
                <Button @click="switchComponents('List', 'Daftar Jenis Layanan', null)" label="Daftar Jenis Layanan" :severity="currentTab==='List'?'primary':'secondary'" icon="pi pi-list"/>
            </div>
            <div class="mt-4 flex gap-x-4">
                <div v-for="jenisLayanan in props.dataJenisLayanan" key="index">
                    <Button @click="switchComponents('List', jenisLayanan.nama_jenis, jenisLayanan.id_jenis)" :label="jenisLayanan.nama_jenis" :severity="pageTitle===jenisLayanan.nama_jenis?'primary':'secondary'"/>
                </div>
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
