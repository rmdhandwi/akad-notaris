<script setup>
// import core api
import { onMounted, ref, watch } from 'vue'
import { router, useForm } from '@inertiajs/vue3'
import { useConfirm } from 'primevue'

// import layouts
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue'

// import store / composables
import { useNotification } from '@/Composables/useNotification'

// lifecycle hooks
onMounted(() =>
{
    pageTitle.value = props.dataPermintaan?.jenis_layanan.nama_jenis
    listJadwal.value = props.dataJadwal
    // setup form
    props.dataPermintaan.jenis_layanan?.kategori_pihak.forEach((pihak, i) => {
        form.berkas[i] = []
        pihak.data_berkas.forEach((berkas) => {
            form.berkas[i].push({
                id_pihak: i === 0
                ? props.dataPermintaan.pihak.id_pihak
                : props.dataPermintaan.pihak.pihak_terkait[i - 1]?.id_pihak ?? null,
                id_berkas: berkas.id_berkas,
                nama_berkas: berkas.nama_berkas,
                file: null,
            })
        })
    })
})
// variables, functions
const props = defineProps({
    dataJadwal : Object,
    dataPermintaan : Object,
})

const confirm = useConfirm()

const { showToast } = useNotification()

const pageTitle = ref('')

const listJadwal = ref([])
const selectedJadwal = ref()

const form = useForm({
    id_permintaan : props.dataPermintaan.id_permintaan,
    id_jenis : props.dataPermintaan.id_jenis,
    id_jadwal : null,
    berkas : [],
})

const handleFileUpload = (index, berkasIndex, event) => {
  form.berkas[index][berkasIndex].file = event.files[0]
  showToast(`${form.berkas[index][berkasIndex].nama_berkas} berhasil diupload`, 'success')
}

const cancelForm = () =>
{
    confirm.require({
        message: `Kembali ke halaman utama ?`,
        header: 'Peringatan',
        icon: 'pi pi-exclamation-triangle',
        rejectProps: {
            label: 'Lanjutkan',
            severity: 'secondary',
            outlined: true,
        },
        acceptProps: {
            label: `Kembali`,
            severity: 'danger',
        },
        accept: () => {
            router.visit(route('klien.permintaan.index'))
        }
    })
}

const uploadBerkas = () =>
{
    confirm.require({
        message: `Upload semua berkas?`,
        header: 'Peringatan',
        icon: 'pi pi-exclamation-triangle',
        rejectProps: {
            label: 'Kembali',
            severity: 'secondary',
            outlined: true,
        },
        acceptProps: {
            label: `Upload`,
            severity: 'success',
        },
        accept: () => {
            form.post(route(`klien.layanan.permintaan.form.store`), {
                    forceFormData: true,
                    onError : () => {
                        showToast(
                            'Terjadi kesalahan',
                            'error',
                            5000,
                        )
                    },
                    onSuccess : () => {
                        form.reset()
                        form.clearErrors()
                    }
            })
        }
    })
}

watch(() => selectedJadwal.value, (jadwal) =>
{
    if(jadwal)
    {
        const filterJadwal = props.dataJadwal.find(data => data.id_jadwal === jadwal.id_jadwal)
        form.id_jadwal = filterJadwal.id_jadwal
    }
})

</script>

<template>
    <AuthenticatedLayout :pageTitle="pageTitle" :sidebarDisabled="true">
        <template #pageContent>
            <div class="flex flex-col gap-4 mt-4">
                <Button @click="cancelForm()" label="Kembali" severity="danger" icon="pi pi-arrow-left" class="w-fit"/>
                <Message severity="warn" size="large" icon="pi pi-info-circle">Silahkan upload berkas untuk masing-masing pihak</Message>
                <form @submit.prevent class="flex flex-col gap-4 mt-4" autocomplete="off" >
                    <div class="flex flex-col gap-y-2">
                        <FloatLabel variant="on">
                            <Select id="nama_jenis" v-model="selectedJadwal" placeholder="Pilih jadwal" :options="listJadwal" fluid>
                                <template #option="slotProps">
                                    <span v-if="slotProps.option">{{ 'Tanggal : '+slotProps.option.tanggal+' | Waktu : '+slotProps.option.waktu_mulai+' - '+slotProps.option.waktu_selesai+' | Notaris : '+slotProps.option.notaris?.nama_notaris }}</span>
                                </template>
                                <template #value="slotProps">
                                    <span v-if="slotProps.value">{{ 'Tanggal : '+slotProps.value.tanggal+' | Waktu : '+slotProps.value.waktu_mulai+' - '+slotProps.value.waktu_selesai+' | Notaris : '+slotProps.value.notaris?.nama_notaris }}</span>
                                </template>
                            </Select>
                        </FloatLabel>
                        <span class="text-red-500" v-if="form.errors.id_jadwal">
                            {{ form.errors.id_jadwal }}
                        </span>
                    </div>
                    <div class="flex flex-col gap-4">
                            <div v-for="(kategori_pihak, index) in props.dataPermintaan.jenis_layanan.kategori_pihak" :key="kategori_pihak.id_kategori_pihak">
                                <span class="text-xl">
                                    {{ kategori_pihak.nama_kategori_pihak }}
                                </span>
                                <div class="mt-4 flex flex-col gap-4" v-for="(berkas, berkasIndex) in form.berkas[index]" :key="berkas.id_berkas">
                                    <div class="card flex flex-wrap gap-6 items-center justify-between border p-2 rounded">
                                        <FileUpload @uploader="handleFileUpload(index, berkasIndex, $event)" mode="basic" :multiple="false" :auto="true" customUpload name="uploadBerkas" :chooseLabel="berkas.nama_berkas" accept=".jpg,.png,.jpeg,.docx,.pdf" :maxFileSize="1000000"/>
                                    </div>
                                    <span class="text-green-500" v-if="form.berkas[index][berkasIndex].file">
                                        {{ `${form.berkas[index][berkasIndex].nama_berkas} berhasil diupload` }}
                                    </span>
                                    <span class="text-red-500" v-if="form.errors[`berkas.${index}.${berkasIndex}.file`]">
                                        {{ form.errors[`berkas.${index}.${berkasIndex}.file`] }}
                                    </span>
                                </div>
                            </div>
                    </div>
                    <Button @click="uploadBerkas()" icon="pi pi-upload" severity="success" label="Upload berkas"/>
                </form>
            </div>
        </template>
    </AuthenticatedLayout>
</template>

<style scoped>
</style>
