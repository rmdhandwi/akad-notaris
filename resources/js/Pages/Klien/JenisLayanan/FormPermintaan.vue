<script setup>
// import core api
import { onMounted, ref } from 'vue'
import { router, useForm } from '@inertiajs/vue3'
import { useConfirm } from 'primevue'

// import layouts
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue'

// lifecycle hooks
onMounted(() =>
{
    pageTitle.value = props.dataPermintaan?.jenis_layanan.nama_jenis
    console.log(props.dataPermintaan)
    console.log(props.dataJadwal)
})
// variables, functions
const props = defineProps({
    dataJadwal : Object,
    dataPermintaan : Object,
})

const confirm = useConfirm()

const pageTitle = ref('')

const form = useForm({
    id_jenis : props.dataPermintaan.id_permintaan,
    id_jadwal : null,
    berkas : [],
})

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
            router.visit(route('klien.layanan.syarat.index'))
        }
    })
}

</script>

<template>
    <AuthenticatedLayout :pageTitle="pageTitle" :sidebarDisabled="true">
        <template #pageContent>
            <div class="flex flex-col gap-4 mt-4">
                <Button @click="cancelForm()" label="Kembali" severity="danger" icon="pi pi-arrow-left" class="w-fit"/>
                <form @submit.prevent class="flex flex-col gap-4 mt-4" autocomplete="off">
                    <div>
                        <FloatLabel variant="on">
                            <Select id="nama_jenis" disabled v-model="form.id_jadwal" placeholder="Jadwal" :options="props.dataJadwal" optionValue="id_jadwal"fluid>
                                <template #option="slotProps">
                                    <span>{{ slotProps.option }}</span>
                                </template>
                            </Select>
                        </FloatLabel>
                    </div>
                </form>
            </div>
        </template>
    </AuthenticatedLayout>
</template>

<style scoped>
</style>
