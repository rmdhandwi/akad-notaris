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
    selectedKategori.value = null
})

// variables, functions
const props = defineProps({
    dataKategoriLayanan : Object
})

const pageTitle = ref('Daftar Jenis Layanan')

const currentTab = ref('List')

const selectedKategori = ref([])
const selectedJenisLayanan = ref([])
const selectedJenisLayananProps = ref([])

const switchComponents = (component,title, id_jenis) =>
{
    if(id_jenis === null) setSelectedKategori(null)
    setSelectedJenisLayananProps(id_jenis)
    currentTab.value = component
    pageTitle.value = title
}

const setSelectedKategori = id_kategori =>
{
    selectedJenisLayananProps.value = null

    if(id_kategori)
    {
        const filterData = props.dataKategoriLayanan.find(data => data.id_kategori === id_kategori)
        selectedKategori.value = filterData
        setJenisLayanan(filterData.jenis_layanan)
    }

    else selectedKategori.value = null
}

const setSelectedJenisLayananProps = id_jenis =>
{
    if(id_jenis)
    {
        const filterData = selectedJenisLayanan.value.find(data => data.id_jenis === id_jenis)
        selectedJenisLayananProps.value = filterData
    }

    else selectedJenisLayananProps.value = null
}

const setJenisLayanan = data =>
{
    if(data)
    {
        selectedJenisLayanan.value = data
    }

    else selectedJenisLayanan.value = null
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
            dataJenisLayanan : selectedJenisLayananProps.value,
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
            <div class="mt-4 flex flex-col gap-y-4">
                <div class="flex items-center gap-x-4">
                    <span>Kategori Layanan : </span>
                    <div v-for="KategoriLayanan in props.dataKategoriLayanan" key="index">
                        <Button @click="setSelectedKategori(KategoriLayanan.id_kategori)" :label="KategoriLayanan.nama_kategori" :severity="selectedKategori?.nama_kategori===KategoriLayanan.nama_kategori?'primary':'secondary'"/>
                    </div>
                </div>
                <div class="flex items-center gap-x-4" v-if="selectedKategori">
                    <span>Jenis Layanan : </span>
                    <div v-for="jenisLayanan in selectedJenisLayanan" key="index">
                        <Button @click="switchComponents('List', jenisLayanan.nama_jenis, jenisLayanan.id_jenis)" :label="jenisLayanan.nama_jenis" :severity="pageTitle===jenisLayanan.nama_jenis?'primary':'secondary'"/>
                    </div>
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
