<script setup>
// import core api
import { onBeforeMount, ref } from 'vue'
import { FilterMatchMode } from '@primevue/core/api'

// import store / composables
import { useFormatTanggal } from '@/Composables/useFormatTanggal'

// lifecycle hooks
onBeforeMount(() =>
{
    dataPermintaanClone.value = props.dataPermintaan.map(item => ({
        ...item,
        permintaan : {
            ...item.permintaan,
            tgl_permintaan : formatToDMY(item.permintaan.tgl_permintaan)
        }
    }))

    console.log(dataPermintaanClone.value)
})

// variables, functions
const props = defineProps({
    dataPermintaan : Object
})

const filters = ref({
    global: { value: null, matchMode: FilterMatchMode.CONTAINS },
})

const dataPermintaanClone = ref([])

const { formatToDMY } = useFormatTanggal()
</script>

<template>
    <div class="flex flex-col">
        <!-- dataTable -->
        <DataTable :value="dataPermintaanClone" dataKey="index" class="shadow border border-blue-500 rounded-lg overflow-hidden" showGridlines removable-sort striped-rows scrollable :filters="filters">
            <template #header>
                <div class="flex flex-col gap-y-2">
                    <!-- Basic Filter -->
                    <div class="flex justify-between items-center gap-x-2">
                        <IconField class="w-full">
                            <InputIcon>
                                <i class="pi pi-search me-4" />
                            </InputIcon>
                            <InputText v-model="filters['global'].value" placeholder="Cari Data Permintaan" size="small" fluid/>
                        </IconField>
                    </div>
                </div>
            </template>
            <template #loading>
                <span class="flex justify-center">Sedang Memuat...</span>
            </template>
            <template #empty>
                <span class="flex justify-center">Tidak Ada Data Permintaan</span>
            </template>
            <Column header="No" field="nomor"/>
            <Column header="Tanggal Permintaan" field="permintaan.tgl_permintaan"/>
            <Column header="Jenis Layanan" field="permintaan.jenis_layanan.nama_jenis"/>
            <Column header="Status" field="permintaan.status"/>
        </DataTable>
    </div>
</template>
