<script setup>
// import core api
import { watch } from 'vue'
import { useForm } from '@inertiajs/vue3'
import { useConfirm } from 'primevue'

// import store / composables
import { useNotification } from '@/Composables/useNotification'

// variables, functions
const props = defineProps({
    data : Object,
})

const emit = defineEmits(['refreshPage'])

const confirm = useConfirm()

const { showToast } = useNotification()

const form = useForm({
    id_kategori : null,
    nama_kategori : null,
    deskripsi_kategori : null,
})

const submit = () =>
{
    const Action = props.data ? 'Update' : 'Simpan'
    confirm.require({
        message: `${Action} Kategori ${form.nama_kategori ?? ''}?`,
        header: 'Peringatan',
        icon: 'pi pi-exclamation-triangle',
        rejectProps: {
            label: 'Batal',
            severity: 'secondary',
            outlined: true,
        },
        acceptProps: {
            label: `${Action}`,
        },
        accept: () => {
            if(props.data)
            {
                form.post(route('admin.layanan.kategori.update'), {
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
            }

            form.post(route('admin.layanan.kategori.store'), {
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
watch(() => props.data, (newData) => {
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
                <InputText id="nama_kategori" v-model="form.nama_kategori" fluid/>
                <label for="nama_kategori">Nama Kategori</label>
            </FloatLabel>
            <span class="text-red-500" v-if="form.errors.nama_kategori"> {{ form.errors.nama_kategori }} </span>
        </div>

        <div>
            <FloatLabel variant="on">
                <Textarea id="deskripsi_kategori" v-model="form.deskripsi_kategori" autoResize fluid/>
                <label for="deskripsi_kategori">Deskripsi Kategori</label>
            </FloatLabel>
            <span class="text-red-500" v-if="form.errors.deskripsi_kategori"> {{ form.errors.deskripsi_kategori }} </span>
        </div>

        <Button @click="submit()" :label="props.data ? 'Update' : 'Simpan'" :disabled="form.processing"/>
    </form>
</template>

<style scoped>
</style>
