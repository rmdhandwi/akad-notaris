<script setup>
// import core api
import { onBeforeMount, ref } from 'vue'
import { FilterMatchMode } from '@primevue/core/api'


// lifecycle hooks
onBeforeMount(() =>
{
    dataJenisClone.value = props.dataJenis
})

// variables, functions
const props = defineProps({
    dataKtg : Object,
    dataJenis : Object
})

const emit = defineEmits(['refreshPage', 'editData'])

const filters = ref({
    global: { value: null, matchMode: FilterMatchMode.CONTAINS },
})

const dataJenisClone = ref([])

const editData = dataId =>
{
    emit('editData', dataId)
}
</script>

<template>
    <div class="flex flex-col">
        <!-- dataTable -->
        <DataTable :value="dataJenisClone" dataKey="index" class="shadow border border-blue-500 rounded-lg overflow-hidden" showGridlines removable-sort striped-rows scrollable>
            <template #header>
                <div class="flex flex-col gap-y-2">
                    <!-- Basic Filter -->
                    <div class="flex justify-between items-center gap-x-2">
                        <IconField class="w-full">
                            <InputIcon>
                                <i class="pi pi-search me-4" />
                            </InputIcon>
                            <InputText v-model="filters['global'].value" placeholder="Cari Jenis Layanan" size="small" fluid/>
                        </IconField>
                    </div>
                </div>
            </template>
            <template #footer>
                <span>Jumlah Jenis Layanan ({{ dataJenisClone.length }})</span>
            </template>
            <template #loading>
                <span class="flex justify-center">Sedang Memuat...</span>
            </template>
            <template #empty>
                <span class="flex justify-center">Tidak Ada Jenis Layanan</span>
            </template>
            <Column header="No" field="nomor"/>
            <Column header="Kategori" field="kategori_layanan.nama_kategori"/>
            <Column header="Nama" field="nama_jenis"/>
            <Column header="Deskripsi" field="deskripsi_jenis">
                <template #body="{data}">
                    <span :class="{'text-gray-400' : !data.deskripsi_jenis}">
                        {{ data.deskripsi_jenis ? data.deskripsi_jenis : 'Tidak ada deskripsi' }}
                    </span>
                </template>
            </Column>
            <Column header="Action" frozen align-frozen="right" class="w-1 whitespace-nowrap">
                <template #body="{data}">
                    <div class="flex items-center gap-2">
                        <Button @click="editData(data.id_jenis)" severity="info" size="small" icon="pi pi-pen-to-square"/>
                    </div>
                </template>
            </Column>
        </DataTable>
    </div>
</template>

<style scoped>
</style>
