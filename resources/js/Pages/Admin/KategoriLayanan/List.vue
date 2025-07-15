<script setup>
// import core api
import { onBeforeMount, ref } from 'vue'
import { FilterMatchMode } from '@primevue/core/api'


// lifecycle hooks
onBeforeMount(() =>
{
    dataClone.value = props.data
})

// variables, functions
const props = defineProps({
    data : Object
})

const emit = defineEmits(['refreshPage', 'editData'])

const filters = ref({
    global: { value: null, matchMode: FilterMatchMode.CONTAINS },
})

const dataClone = ref([])

const editData = dataId =>
{
    emit('editData', dataId)
}
</script>

<template>
    <div class="flex flex-col">
        <!-- dataTable -->
        <DataTable :value="dataClone" dataKey="index" class="shadow border border-blue-500 rounded-lg overflow-hidden" showGridlines removable-sort striped-rows scrollable :filters="filters">
            <template #header>
                <div class="flex flex-col gap-y-2">
                    <!-- Basic Filter -->
                    <div class="flex justify-between items-center gap-x-2">
                        <IconField class="w-full">
                            <InputIcon>
                                <i class="pi pi-search me-4" />
                            </InputIcon>
                            <InputText v-model="filters['global'].value" placeholder="Cari Kategori" size="small" fluid/>
                        </IconField>
                    </div>
                </div>
            </template>
            <template #footer>
                <span>Jumlah Kategori ({{ dataClone.length }})</span>
            </template>
            <template #loading>
                <span class="flex justify-center">Sedang Memuat...</span>
            </template>
            <template #empty>
                <span class="flex justify-center">Tidak Ada Kategori</span>
            </template>
            <Column header="No" field="nomor"/>
            <Column header="Nama" field="nama_kategori"/>
            <Column header="Deskripsi" field="deskripsi_kategori">
                <template #body="{data}">
                    <span :class="{'text-gray-400' : !data.deskripsi_kategori}">
                        {{ data.deskripsi_kategori ? data.deskripsi_kategori : 'Tidak ada deskripsi' }}
                    </span>
                </template>
            </Column>
            <Column header="Action" frozen align-frozen="right" class="w-1 whitespace-nowrap">
                <template #body="{data}">
                    <div class="flex items-center gap-2">
                        <Button @click="editData(data.id_kategori)" severity="info" size="small" icon="pi pi-pen-to-square"/>
                    </div>
                </template>
            </Column>
        </DataTable>
    </div>
</template>

<style scoped>
</style>
