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
    dataNotaris : Object,
})

const emit = defineEmits(['refreshPage'])

const confirm = useConfirm()

const { showToast } = useNotification()

const form = useForm({
    user_id : null,
    username : null,
    email : null,
    password : null,
    notaris_details : {
        notaris_id : null,
        nomor_jabatan_notaris : null,
        nama_notaris : null,
    }
})

const submit = (Action, actionRoute) =>
{
    confirm.require({
        message: `${Action} Notaris ${form.notaris_details.nama_notaris ?? ''}?`,
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
            form.post(route(`admin.users.notaris.${actionRoute}`), {
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
watch(() => props.dataNotaris, (newData) => {
  if (newData) {
    // Isi level utama form
    Object.assign(form, {
        user_id: newData.user_id,
        username: newData.username,
        email: newData.email,
        password: null, // kosongkan password untuk form edit
    })

    // Isi nested notaris_details hanya jika tersedia
    if (newData.notaris_details) {
        Object.assign(form.notaris_details, {
            notaris_id: newData.notaris_details.notaris_id,
            nomor_jabatan_notaris: newData.notaris_details.nomor_jabatan_notaris,
            nama_notaris: newData.notaris_details.nama_notaris,
        })
    } else {
        // opsional: reset manual jika notaris_details kosong
        Object.assign(form.notaris_details, {
            notaris_id: null,
            nomor_jabatan_notaris: null,
            nama_notaris: null,
        })
    }
  } else {
    form.reset()
  }
}, { immediate: true })

</script>

<template>
    <form @submit.prevent class="flex flex-col gap-4 mt-4" autocomplete="off">
        <div>
            <FloatLabel variant="on">
                <InputText id="notaris_details.nomor_jabatan_notaris" v-model="form.notaris_details.nomor_jabatan_notaris" fluid/>
                <label for="notaris_details.nomor_jabatan_notaris">Nomor Jabatan notaris</label>
            </FloatLabel>
            <span class="text-red-500" v-if="form.errors['notaris_details.nomor_jabatan_notaris']"> {{ form.errors['notaris_details.nomor_jabatan_notaris'] }} </span>
        </div>

        <div>
            <FloatLabel variant="on">
                <InputText id="notaris_details.nama_notaris" v-model="form.notaris_details.nama_notaris" fluid/>
                <label for="notaris_details.nama_notaris">Nama Notaris</label>
            </FloatLabel>
            <span class="text-red-500" v-if="form.errors['notaris_details.nama_notaris']"> {{ form.errors['notaris_details.nama_notaris'] }} </span>
        </div>

        <div>
            <FloatLabel variant="on">
                <InputText id="staf_username" v-model="form.username" fluid/>
                <label for="staf_username">Username</label>
            </FloatLabel>
            <span class="text-red-500" v-if="form.errors.username"> {{ form.errors.username }} </span>
        </div>

        <div>
            <FloatLabel variant="on">
                <InputText id="staf_email" v-model="form.email" fluid/>
                <label for="staf_email">Email</label>
            </FloatLabel>
            <span class="text-red-500" v-if="form.errors.email"> {{ form.errors.email }} </span>
        </div>

        <div>
            <FloatLabel variant="on">
                <Password id="staf_password" :defaultValue="null" v-model="form.password" toggleMask fluid/>
                <label for="staf_password">Password</label>
            </FloatLabel>
            <span class="text-red-500" v-if="form.errors.password">
                {{ form.errors.password }}
            </span>
        </div>

        <Button @click="submit(props.dataNotaris ? 'Update' : 'Simpan', props.dataNotaris ? 'update' : 'store')" :label="props.dataNotaris ? 'Update' : 'Simpan'" :disabled="form.processing"/>
        <Button @click="submit('Hapus', 'delete')" label="Hapus" :disabled="form.processing" severity="danger" v-if="props.dataNotaris"/>
    </form>
</template>
