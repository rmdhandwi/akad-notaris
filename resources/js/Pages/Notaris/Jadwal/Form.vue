<script setup>
// import core api
import { ref, watch } from 'vue'
import { useForm } from '@inertiajs/vue3'
import { useConfirm } from 'primevue'

// import store / composables
import { useNotification } from '@/Composables/useNotification'

// lifecycle hooks

// variables, functions
const props = defineProps({
    dataJadwal : Object,
})

const emit = defineEmits(['refreshPage'])

const confirm = useConfirm()

const { showToast } = useNotification()

const minDate = ref(new Date());

const minTime = ref(new Date());
minTime.value.setHours(9, 0, 0); // jam 09:00:00

const maxTime = ref(new Date());
maxTime.value.setHours(15, 30, 0); // jam 16:00:00

const maxWaktuSelesai = ref(new Date());
maxWaktuSelesai.value.setHours(16, 0, 0); // jam 16:00:00

const form = useForm({
    id_jadwal : null,
    notaris_id : null,
    tanggal : null,
    waktu_mulai : null,
    waktu_selesai : null,
    alasan : null,
})

function formatTime(date) {
    return date.toLocaleTimeString('en-GB', {
    hour: '2-digit',
    minute: '2-digit',
    hour12: false
    });
}

const submit = (Action, actionRoute) =>
{
    confirm.require({
        message: `${Action} Jadwal ?`,
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
            form.transform((data) => ({
                ...data,
                waktu_mulai: data.waktu_mulai ? formatTime(data.waktu_mulai) : null,
                waktu_selesai: data.waktu_selesai ? formatTime(data.waktu_selesai) : null,
            }));
            form.post(route(`notaris.layanan.jadwal.${actionRoute}`), {
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
watch(() => props.dataJadwal, (newData) => {
  if (newData) {
    Object.assign(form, newData)
  } else {
    form.reset()
  }
}, { immediate: true })

watch(() => form.waktu_mulai, (waktuMulai) =>
{
    if(waktuMulai)
    {
        const waktu_mulai = new Date(waktuMulai)
        const waktu_selesai = new Date(waktu_mulai)
        waktu_selesai.setMinutes(waktu_mulai.getMinutes() + 30)
        form.waktu_selesai = waktu_selesai
    }
})

</script>

<template>
    <form @submit.prevent class="flex flex-col gap-4 mt-4" autocomplete="off">

        <span class="text-red-500" v-if="form.errors.notaris_id"> {{ form.errors.notaris_id }} </span>

        <div>
            <FloatLabel variant="on">
                <DatePicker v-model="form.tanggal" inputId="on_label" :minDate="minDate" showIcon iconDisplay="input" dateFormat="dd-mm-yy" fluid/>
                <label for="on_label">Tanggal</label>
            </FloatLabel>
            <span class="text-red-500" v-if="form.errors.tanggal"> {{ form.errors.tanggal }} </span>
        </div>

        <div>
            <FloatLabel variant="on">
                <DatePicker v-model="form.waktu_mulai" inputId="on_label" showIcon :stepMinute="30" :minDate="minTime" :maxDate="maxTime" icon="pi pi-clock" iconDisplay="input" timeOnly fluid/>
                <label for="on_label">Waktu mulai</label>
            </FloatLabel>
            <span class="text-red-500" v-if="form.errors.waktu_mulai"> {{ form.errors.waktu_mulai }} </span>
        </div>

        <div>
            <FloatLabel variant="on">
                <DatePicker v-model="form.waktu_selesai" inputId="on_label" showIcon :stepMinute="30" :minDate="minTime" :maxDate="maxWaktuSelesai" icon="pi pi-clock" iconDisplay="input" timeOnly :disabled="!form.waktu_mulai" fluid/>
                <label for="on_label">Waktu selesai</label>
            </FloatLabel>
            <span class="text-red-500" v-if="form.errors.waktu_selesai"> {{ form.errors.waktu_selesai }} </span>
        </div>

        <div>
            <FloatLabel variant="on">
                <Textarea id="alasan" v-model="form.alasan" autoResize fluid/>
                <label for="alasan">Alasan / Kendala</label>
            </FloatLabel>
            <span class="text-slate-500" v-if="!form.alasan">*Kosongkan jika tidak ada kendala</span>
            <span class="text-red-500" v-if="form.errors.alasan"> {{ form.errors.alasan }} </span>
        </div>

        <Button @click="submit(props.dataJadwal ? 'Update' : 'Simpan', props.dataJadwal ? 'update' : 'store')" :label="props.dataJadwal ? 'Update' : 'Simpan'" :disabled="form.processing"/>
        <Button @click="submit('Hapus', 'delete')" label="Hapus" :disabled="form.processing" severity="danger" v-if="props.dataJadwal"/>
    </form>
</template>
