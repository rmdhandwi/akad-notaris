<script setup>
// import core api
import { onMounted, ref, watch } from 'vue'
import { useForm } from '@inertiajs/vue3'
import { useConfirm } from 'primevue'

// import store / composables
import { useNotification } from '@/Composables/useNotification'

// lifecycle hooks
onMounted(() =>
{
    if(props.dataBerkas)
    {
        setKategoriPihak(props.dataBerkas.id_jenis)
    }
})

// variables, functions
const props = defineProps({
    dataBerkas : Object,
    dataJenis : Object,
})

const emit = defineEmits(['refreshPage'])

const confirm = useConfirm()

const { showToast } = useNotification()

const form = useForm({
    id_berkas : null,
    id_jenis : null,
    id_kategori_pihak : null,
    nama_berkas : null,
})

const kategoriPihak = ref([])

const setKategoriPihak = id_jenis =>
{
    const filterData = props.dataJenis.find(data => data.id_jenis === id_jenis)
    kategoriPihak.value = filterData ? filterData.kategori_pihak : []
}

const submit = (Action, actionRoute) =>
{
    confirm.require({
        message: `${Action} Berkas ${form.nama_berkas ?? ''}?`,
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
            form.post(route(`admin.berkas.${actionRoute}`), {
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
watch(() => props.dataBerkas, (newData) => {
  if (newData) {
    Object.assign(form, newData)
  } else {
    form.reset()
  }
}, { immediate: true })

watch(() => form.id_jenis, (newVal) => {
    setKategoriPihak(newVal)
    form.id_kategori_pihak = null
})

</script>

<template>
    <form @submit.prevent class="flex flex-col gap-4 mt-4" autocomplete="off">

        <div>
            <FloatLabel variant="on">
                <Select id="nama_jenis" v-model="form.id_jenis" placeholder="Jenis Layanan" :options="props.dataJenis" optionLabel="nama_jenis" optionValue="id_jenis" fluid/>
            </FloatLabel>
            <span class="text-red-500" v-if="form.errors.id_jenis"> {{ form.errors.id_jenis }} </span>
        </div>

        <div>
            <FloatLabel variant="on">
                <Select id="kategori_pihak" :disabled="!form.id_jenis" v-model="form.id_kategori_pihak" placeholder="Kategori Pihak" :options="kategoriPihak" optionLabel="nama_kategori_pihak" optionValue="id_kategori_pihak" fluid/>
            </FloatLabel>
            <span class="text-red-500" v-if="form.errors.id_kategori_pihak"> {{ form.errors.id_kategori_pihak }} </span>
        </div>

        <div>
            <FloatLabel variant="on">
                <InputText id="nama_berkas" v-model="form.nama_berkas" fluid/>
                <label for="nama_berkas">Nama Berkas</label>
            </FloatLabel>
            <span class="text-red-500" v-if="form.errors.nama_berkas"> {{ form.errors.nama_berkas }} </span>
        </div>

        <Button @click="submit(props.dataBerkas ? 'Update' : 'Simpan', props.dataBerkas ? 'update' : 'store')" :label="props.dataBerkas ? 'Update' : 'Simpan'" :disabled="form.processing"/>
        <Button @click="submit('Hapus', 'delete')" label="Hapus" :disabled="form.processing" severity="danger" v-if="props.dataBerkas"/>
    </form>
</template>
