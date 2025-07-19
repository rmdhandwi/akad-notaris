<script setup>
// import core api
import { onMounted, ref } from 'vue'
import { useForm } from '@inertiajs/vue3'
import { useConfirm } from 'primevue'

// import store / composables
import { useNotification } from '@/Composables/useNotification'

// lifecycle hooks
onMounted(() =>
{

})
// variables, functions
const props = defineProps({
    dataJenisLayanan : Object,
})

const confirm = useConfirm()

const { showToast } = useNotification()

const formType = ref('pihak')

const form = useForm({
    id_jenis : props.dataJenisLayanan[0].id_jenis,
    pihak : props.dataJenisLayanan?.map(data => {
        return {
            user_id : null,
            id_pihak_terkait : null,
            id_kategori_pihak : data.id_kategori_pihak,
            nama_pihak : null,
            nik_pihak : null,
            no_hp_pihak : null,
            alamat_pihak : null,
            tipe_pihak : `Pihak ke-${data.pihak_ke}`,
        }
    }),
})

const submit = (Action, actionRoute) =>
{
    confirm.require({
        message: `${Action} Data pihak ?`,
        header: 'Peringatan',
        icon: 'pi pi-exclamation-triangle',
        rejectProps: {
            label: 'Batal',
            severity: 'secondary',
            outlined: true,
        },
        acceptProps: {
            label: `${Action}`,
            severity : actionRoute === 'delete' ? 'danger' : 'primary'
        },
        accept: () => {
            form.post(route(`klien.layanan.data_pihak.${actionRoute}`), {
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
        },
    })
}

</script>

<template>
    <form @submit.prevent class="flex flex-col gap-4 mt-4" autocomplete="off">
        <div v-if="formType==='pihak'" class="flex flex-col gap-4">
            <Message severity="warn" size="large" icon="pi pi-info-circle">Silahkan isi data untuk masing-masing pihak</Message>
            <div v-for="(kategori_pihak, index) in props.dataJenisLayanan" key="index">
                <div class="flex flex-col gap-4">
                    <span>Pihak ke : {{ kategori_pihak.pihak_ke }}</span>
                    <div>
                        <FloatLabel variant="on">
                            <Select id="nama_jenis" disabled v-model="form.pihak[index].id_kategori_pihak" placeholder="Kategori Pihak" :options="props.dataJenisLayanan" optionLabel="nama_kategori_pihak" optionValue="id_kategori_pihak" fluid/>
                        </FloatLabel>
                        <span class="text-red-500" v-if="form.errors[`pihak.${index}.id_kategori_pihak`]">
                            {{ form.errors[`pihak.${index}.id_kategori_pihak`] }}
                        </span>
                    </div>
                    <div>
                        <FloatLabel variant="on">
                            <InputText id="nama_pihak" v-model="form.pihak[index].nama_pihak" fluid/>
                            <label for="nama_pihak">Nama Pihak {{ kategori_pihak.pihak_ke }}</label>
                        </FloatLabel>
                        <span class="text-red-500" v-if="form.errors[`pihak.${index}.nama_pihak`]">
                            {{ form.errors[`pihak.${index}.nama_pihak`] }}
                        </span>
                    </div>
                    <div>
                        <FloatLabel variant="on">
                            <InputText id="nik_pihak" v-model="form.pihak[index].nik_pihak" fluid/>
                            <label for="nik_pihak">NIK Pihak {{ kategori_pihak.pihak_ke }}</label>
                        </FloatLabel>
                        <span class="text-red-500" v-if="form.errors[`pihak.${index}.nik_pihak`]">
                            {{ form.errors[`pihak.${index}.nik_pihak`] }}
                        </span>
                    </div>
                    <div>
                        <FloatLabel variant="on">
                            <InputText id="no_hp_pihak" v-model="form.pihak[index].no_hp_pihak" fluid/>
                            <label for="no_hp_pihak">Nomor HP Pihak {{ kategori_pihak.pihak_ke }}</label>
                        </FloatLabel>
                        <span class="text-red-500" v-if="form.errors[`pihak.${index}.no_hp_pihak`]">
                            {{ form.errors[`pihak.${index}.no_hp_pihak`] }}
                        </span>
                    </div>
                    <div>
                        <FloatLabel variant="on">
                            <InputText id="alamat_pihak" v-model="form.pihak[index].alamat_pihak" fluid/>
                            <label for="alamat_pihak">Alamat Pihak {{ kategori_pihak.pihak_ke }}</label>
                        </FloatLabel>
                        <span class="text-red-500" v-if="form.errors[`pihak.${index}.alamat_pihak`]">
                            {{ form.errors[`pihak.${index}.alamat_pihak`] }}
                        </span>
                    </div>
                    <div>
                        <FloatLabel variant="on">
                            <InputText id="tipe_pihak" disabled v-model="form.pihak[index].tipe_pihak" fluid/>
                            <label for="tipe_pihak">Tipe Pihak</label>
                        </FloatLabel>
                        <span class="text-red-500" v-if="form.errors[`pihak.${index}.pihak_ke`]">
                            {{ form.errors[`pihak.${index}.pihak_ke`] }}
                        </span>
                    </div>
                </div>
            </div>
            <Button @click="submit('Simpan', 'store')" label="Lanjut ke upload berkas" :disabled="form.processing"/>
        </div>
    </form>
</template>
