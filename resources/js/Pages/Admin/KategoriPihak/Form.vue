<script setup>
// import core api
import { watch } from 'vue'
import { useForm } from '@inertiajs/vue3'
import { useConfirm } from 'primevue'

// import store / composables
import { useNotification } from '@/Composables/useNotification'

// lifecycle hooks

// variables, functions
const props = defineProps({
    dataJenis : Object,
    dataKtgPihak : Object,
})

const emit = defineEmits(['refreshPage'])

const confirm = useConfirm()

const { showToast } = useNotification()

const form = useForm({
    id_kategori_pihak : null,
    id_jenis : null,
    nama_kategori_pihak : null,
})

const submit = (Action, actionRoute) =>
{
    confirm.require({
        message: `${Action} Kategori pihak ${form.nama_kategori_pihak ?? ''}?`,
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
            form.post(route(`admin.layanan.pihak.${actionRoute}`), {
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
                        emit('refreshPage')
                    }
            })
        },
    })
}

// reactivity
watch(() => props.dataKtgPihak, (newData) => {
  if (newData) {
    // Isi level utama form
    Object.assign(form, newData)
  } else {
    form.reset()
  }
}, { immediate: true })

</script>

<template>
    <form @submit.prevent class="flex flex-col gap-4 mt-4" autocomplete="off">

        <div>
            <FloatLabel variant="on">
                <Select id="id_jenis" v-model="form.id_jenis" placeholder="Jenis layanan" :options="props.dataJenis" optionLabel="nama_jenis" optionValue="id_jenis"  fluid/>
            </FloatLabel>
            <span class="text-red-500" v-if="form.errors.id_jenis"> {{ form.errors.id_jenis }} </span>
        </div>

        <div>
            <FloatLabel variant="on">
                <InputText id="nama_kategori_pihak" v-model="form.nama_kategori_pihak" fluid/>
                <label for="nama_kategori_pihak">Nama Kategori Pihak</label>
            </FloatLabel>
            <span class="text-red-500" v-if="form.errors.nama_kategori_pihak"> {{ form.errors.nama_kategori_pihak }} </span>
        </div>

        <Button @click="submit(props.dataKtgPihak ? 'Update' : 'Simpan', props.dataKtgPihak ? 'update' : 'store')" :label="props.dataKtgPihak ? 'Update' : 'Simpan'" :disabled="form.processing"/>
        <Button @click="submit('Hapus', 'delete')" label="Hapus" :disabled="form.processing" severity="danger" v-if="props.dataKtgPihak"/>
    </form>
</template>
