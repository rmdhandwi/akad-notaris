<script setup>
// import core api
import { onBeforeMount, ref } from 'vue'
import { FilterMatchMode } from '@primevue/core/api'


// lifecycle hooks
onBeforeMount(() =>
{
    dataNotarisClone.value = props.dataNotaris
})

// variables, functions
const props = defineProps({
    dataNotaris : Object
})

const emit = defineEmits(['refreshPage', 'editData'])

const filters = ref({
    global: { value: null, matchMode: FilterMatchMode.CONTAINS },
})

const dataNotarisClone = ref([])

const editData = dataId =>
{
    emit('editData', dataId)
}
</script>

<template>
    <div class="flex flex-col">
        <!-- dataTable -->
        <DataTable :value="dataNotarisClone" dataKey="index" class="shadow border border-blue-500 rounded-lg overflow-hidden" showGridlines removable-sort striped-rows scrollable :filters="filters">
            <template #header>
                <div class="flex flex-col gap-y-2">
                    <!-- Basic Filter -->
                    <div class="flex justify-between items-center gap-x-2">
                        <IconField class="w-full">
                            <InputIcon>
                                <i class="pi pi-search me-4" />
                            </InputIcon>
                            <InputText v-model="filters['global'].value" placeholder="Cari Notaris" size="small" fluid/>
                        </IconField>
                    </div>
                </div>
            </template>
            <template #footer>
                <span>Jumlah Notaris ({{ dataNotarisClone.length }})</span>
            </template>
            <template #loading>
                <span class="flex justify-center">Sedang Memuat...</span>
            </template>
            <template #empty>
                <span class="flex justify-center">Tidak Ada Notaris</span>
            </template>
            <Column header="No" field="nomor"/>
            <Column header="Nomor Jabatan" field="notaris_details.nomor_jabatan_notaris">
                <template #body="{data}">
                    <span :class="{'text-gray-400' : !data.notaris_details?.nomor_jabatan_notaris}">
                        {{ data.notaris_details?.nomor_jabatan_notaris ? data.notaris_details?.nomor_jabatan_notaris : 'Nomor Jabatan notaris belum diinput' }}
                    </span>
                </template>
            </Column>
            <Column header="Nama" field="notaris_details.nama_notaris">
                <template #body="{data}">
                    <span :class="{'text-gray-400' : !data.notaris_details?.nama_notaris}">
                        {{ data.notaris_details?.nama_notaris ? data.notaris_details?.nama_notaris : 'Nama Notaris belum diinput' }}
                    </span>
                </template>
            </Column>
            <Column header="Username" field="username"/>
            <Column header="Email" field="email"/>
            <Column header="Action" frozen align-frozen="right" class="w-1 whitespace-nowrap">
                <template #body="{data}">
                    <div class="flex items-center gap-2">
                        <Button @click="editData(data.user_id)" severity="info" size="small" icon="pi pi-pen-to-square"/>
                    </div>
                </template>
            </Column>
        </DataTable>
    </div>
</template>

<style scoped>
</style>
