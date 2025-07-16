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
    dataStaf : Object,
})

const emit = defineEmits(['refreshPage'])

const confirm = useConfirm()

const { showToast } = useNotification()

const form = useForm({
    user_id : null,
    username : null,
    email : null,
    password : null,
    staf_details : {
        staf_id : null,
        nik_staf : null,
        nama_staf : null,
    }
})

const submit = (Action, actionRoute) =>
{
    confirm.require({
        message: `${Action} Staf ${form.staf_details.nama_staf ?? ''}?`,
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
            form.post(route(`admin.users.staf_details.${actionRoute}`), {
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
watch(() => props.dataStaf, (newData) => {
  if (newData) {
    // Isi level utama form
    Object.assign(form, {
        user_id: newData.user_id,
        username: newData.username,
        email: newData.email,
        password: null, // kosongkan password untuk form edit
    })

    // Isi nested staf_details hanya jika tersedia
    if (newData.staf_details) {
        Object.assign(form.staf_details, {
            staf_id: newData.staf_details.staf_id,
            nik_staf: newData.staf_details.nik_staf,
            nama_staf: newData.staf_details.nama_staf,
        })
    } else {
        // opsional: reset manual jika staf_details kosong
        Object.assign(form.staf_details, {
            staf_id: null,
            nik_staf: null,
            nama_staf: null,
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
                <InputText id="staf_details.nik_staf" v-model="form.staf_details.nik_staf" fluid/>
                <label for="staf_details.nik_staf">NIK Staf</label>
            </FloatLabel>
            <span class="text-red-500" v-if="form.errors['staf_details.nik_staf']"> {{ form.errors['staf_details.nik_staf'] }} </span>
        </div>

        <div>
            <FloatLabel variant="on">
                <InputText id="staf_details.nama_staf" v-model="form.staf_details.nama_staf" fluid/>
                <label for="staf_details.nama_staf">Nama Staf</label>
            </FloatLabel>
            <span class="text-red-500" v-if="form.errors['staf_details.nama_staf']"> {{ form.errors['staf_details.nama_staf'] }} </span>
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
            <span class="text-sm text-red-500 mx-2" v-if="form.errors.password">
                {{ form.errors.password }}
            </span>
        </div>

        <Button @click="submit(props.dataStaf ? 'Update' : 'Simpan', props.dataStaf ? 'update' : 'store')" :label="props.dataStaf ? 'Update' : 'Simpan'" :disabled="form.processing"/>
        <Button @click="submit('Hapus', 'delete')" label="Hapus" :disabled="form.processing" severity="danger" v-if="props.dataStaf"/>
    </form>
</template>
