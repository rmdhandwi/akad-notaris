<script setup>
// import core api
import { onBeforeMount, ref } from 'vue'
import { FilterMatchMode } from '@primevue/core/api'

// import store / composables
import { useFormatTanggal } from '@/Composables/useFormatTanggal'

// lifecycle hooks
onBeforeMount(() =>
{
    dataJadwalClone.value = props.dataJadwal.map(item => ({
        ...item,
        tanggal : formatToDMY(item.tanggal)
    }))
})

// variables, functions
const props = defineProps({
    dataJadwal : Object
})

const filters = ref({
    global: { value: null, matchMode: FilterMatchMode.CONTAINS },
})

const dataJadwalClone = ref([])

const { formatToDMY } = useFormatTanggal()
</script>

<template>
    <div class="flex flex-col">
        <!-- dataTable -->
        <DataTable :value="dataJadwalClone" dataKey="index" class="shadow border border-blue-500 rounded-lg overflow-hidden" showGridlines removable-sort striped-rows scrollable :filters="filters">
            <template #header>
                <div class="flex flex-col gap-y-2">
                    <!-- Basic Filter -->
                    <div class="flex justify-between items-center gap-x-2">
                        <IconField class="w-full">
                            <InputIcon>
                                <i class="pi pi-search me-4" />
                            </InputIcon>
                            <InputText v-model="filters['global'].value" placeholder="Cari Data Jadwal" size="small" fluid/>
                        </IconField>
                    </div>
                </div>
            </template>
            <template #loading>
                <span class="flex justify-center">Sedang Memuat...</span>
            </template>
            <template #empty>
                <span class="flex justify-center">Tidak Ada Data Jadwal</span>
            </template>
            <Column header="No" field="nomor"/>
            <Column header="Tanggal" field="tanggal"/>
            <Column header="Nama Notaris" field="notaris.nama_notaris"/>
            <Column header="Waktu Mulai" field="waktu_mulai"/>
            <Column header="Waktu Selesai" field="waktu_selesai"/>
        </DataTable>
    </div>
</template>
