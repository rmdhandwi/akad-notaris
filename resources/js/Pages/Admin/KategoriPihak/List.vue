<script setup>
// import core api
import { onBeforeMount, ref } from 'vue'
import { FilterMatchMode } from '@primevue/core/api'


// lifecycle hooks
onBeforeMount(() =>
{
    dataKtgPihakClone.value = props.dataKtgPihak
})

// variables, functions
const props = defineProps({
    dataKtgPihak : Object,
})

const emit = defineEmits(['refreshPage', 'editData'])

const filters = ref({
    global: { value: null, matchMode: FilterMatchMode.CONTAINS },
})

const dataKtgPihakClone = ref([])

const editData = dataId =>
{
    emit('editData', dataId)
}
</script>

<template>
    <div class="flex flex-col">
        <!-- dataTable -->
        <DataTable :value="dataKtgPihakClone" dataKey="index" class="shadow border border-blue-500 rounded-lg overflow-hidden" showGridlines removable-sort striped-rows scrollable :filters="filters">
            <template #header>
                <div class="flex flex-col gap-y-2">
                    <!-- Basic Filter -->
                    <div class="flex justify-between items-center gap-x-2">
                        <IconField class="w-full">
                            <InputIcon>
                                <i class="pi pi-search me-4" />
                            </InputIcon>
                            <InputText v-model="filters['global'].value" placeholder="Cari Kategori Pihak" size="small" fluid/>
                        </IconField>
                    </div>
                </div>
            </template>
            <template #footer>
                <span>Jumlah Kategori Pihak ({{ dataKtgPihakClone.length }})</span>
            </template>
            <template #loading>
                <span class="flex justify-center">Sedang Memuat...</span>
            </template>
            <template #empty>
                <span class="flex justify-center">Tidak Ada Kategori Pihak</span>
            </template>
            <Column header="No" field="nomor"/>
            <Column header="Jenis Layanan" field="jenis_layanan.nama_jenis"/>
            <Column header="Nama Kategori Pihak" field="nama_kategori_pihak"/>
            <Column header="Action" frozen align-frozen="right" class="w-1 whitespace-nowrap">
                <template #body="{data}">
                    <div class="flex items-center gap-2">
                        <Button @click="editData(data.id_kategori_pihak)" severity="info" size="small" icon="pi pi-pen-to-square"/>
                    </div>
                </template>
            </Column>
        </DataTable>
    </div>
</template>

<style scoped>
</style>
