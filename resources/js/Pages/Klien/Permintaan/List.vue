<script setup>
// import core api
import { onBeforeMount, ref } from 'vue'
import { FilterMatchMode } from '@primevue/core/api'
import { useForm } from '@inertiajs/vue3'
import { useConfirm } from 'primevue'

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
const confirm = useConfirm()

const filters = ref({
    global: { value: null, matchMode: FilterMatchMode.CONTAINS },
})

const dataPermintaanClone = ref([])

const { formatToDMY } = useFormatTanggal()

const form = useForm({
    id_permintaan : null,
})

const uploadBerkas = (id_permintaan) =>
{
    form.id_permintaan = id_permintaan

    console.log(form.id_permintaan)

    confirm.require({
        message: `Lanjut ke upload berkas ?`,
        header: 'Peringatan',
        icon: 'pi pi-exclamation-triangle',
        rejectProps: {
            label: 'Batal',
            severity: 'secondary',
            outlined: true,
        },
        acceptProps: {
            label: `Lanjut`,
        },
        accept: () => {
            form.post(route('klien.layanan.permintaan.simpan-id'))
        }
    })
}
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
            <Column header="Action" frozen align-frozen="right">
                <template #body="{data}">
                    <Button @click="uploadBerkas(data.permintaan.id_permintaan)" outlined icon="pi pi-file" label="Upload berkas" size="small" v-if="!data.permintaan.id_jadwal"/>
                    <Message severity="warn" size="small" v-else>Menunggu validasi staf</Message>
                </template>
            </Column>
        </DataTable>
    </div>
</template>
