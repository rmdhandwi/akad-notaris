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
    dataKtg : Object,
    dataJenis : Object,
})

const emit = defineEmits(['refreshPage'])

const confirm = useConfirm()

const { showToast } = useNotification()

const form = useForm({
    id_jenis : null,
    id_kategori : null,
    nama_jenis : null,
    deskripsi_jenis : null,
})

const submit = (Action, actionRoute) =>
{
    confirm.require({
        message: `${Action} Jenis Layanan ${form.nama_jenis ?? ''}?`,
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
            form.post(route(`admin.layanan.jenis.${actionRoute}`), {
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
watch(() => props.dataJenis, (newData) => {
  if (newData) {
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
                <Select id="nama_jenis" v-model="form.id_kategori" placeholder="Kategori Layanan" :options="props.dataKtg" optionLabel="nama_kategori" optionValue="id_kategori" fluid/>
            </FloatLabel>
            <span class="text-red-500" v-if="form.errors.id_kategori"> {{ form.errors.id_kategori }} </span>
        </div>
        <div>
            <FloatLabel variant="on">
                <InputText id="nama_jenis" v-model="form.nama_jenis" fluid/>
                <label for="nama_jenis">Nama Jenis</label>
            </FloatLabel>
            <span class="text-red-500" v-if="form.errors.nama_jenis"> {{ form.errors.nama_jenis }} </span>
        </div>

        <div>
            <FloatLabel variant="on">
                <Textarea id="deskripsi_jenis" v-model="form.deskripsi_jenis" autoResize fluid/>
                <label for="deskripsi_jenis">Deskripsi Jenis</label>
            </FloatLabel>
            <span class="text-red-500" v-if="form.errors.deskripsi_jenis"> {{ form.errors.deskripsi_jenis }} </span>
        </div>

        <Button @click="submit(props.dataJenis ? 'Update' : 'Simpan', props.dataJenis ? 'update' : 'store')" :label="props.dataJenis ? 'Update' : 'Simpan'" :disabled="form.processing"/>
        <Button @click="submit('Hapus', 'delete')" label="Hapus" :disabled="form.processing" severity="danger" v-if="props.dataJenis"/>
    </form>
</template>
