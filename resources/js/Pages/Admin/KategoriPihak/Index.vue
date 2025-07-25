<script setup>
// import core api
import { computed, defineAsyncComponent, ref, watch } from 'vue'
import { useConfirm } from 'primevue'

// import store / composables

// import layout, components
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue'
import LoadingSpinner from '@/Components/LoadingSpinner.vue'

// lifecycle hooks

// variables, functions
const props = defineProps({
    dataJenis : Object,
    dataKtgPihak : Object,
})

const pageTitle = ref('Data Kategori Pihak')

const currentTab = ref('List')

const editDataId = ref(null)

const confirm = useConfirm()

const switchComponents = (component,title) =>
{
    currentTab.value = component
    pageTitle.value = title
}

// async component
const loadComponent = componentName =>
{
    return  defineAsyncComponent({
        loader : () => import(`./${componentName}.vue`),
        loadingComponent : LoadingSpinner,
        delay : 200,
        timeout: 3000
    })
}

const currentComponent = computed(() => {
  return loadComponent(currentTab.value)
})

const componentProps = computed(() => {
    switch (currentTab.value) {

        case 'List':
        return {
            dataKtgPihak : props.dataKtgPihak?.map((p, i) => ({ nomor: i + 1, ...p })),
            dataJenis : props.dataJenis,
        };

        case 'Form' :
            if(editDataId.value) {
                return {
                    dataKtgPihak : props.dataKtgPihak?.find(data => data.id_kategori_pihak === editDataId.value),
                    dataJenis : props.dataJenis,
                }
            }
            else {
                return {
                    dataJenis : props.dataJenis,
                }
            };
        default:
        return {};
    }
})

const toggleEdit = dataEmit =>
{
    editDataId.value = dataEmit
}

const cancelEdit = () =>
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
            editDataId.value = null
            switchComponents('List','Daftar Kategori Pihak')
        }
    })
}

const refreshPage = () =>
{
    editDataId.value = null
    switchComponents('List','Daftar Kategori Pihak')
}

// reactivity
watch(() => editDataId.value, () => {
    if(editDataId.value) {
        switchComponents('Form', 'Edit Kategori Pihak')
    }
})
</script>

<template>
    <AuthenticatedLayout :pageTitle="pageTitle">
        <template #pageContent>
            <!-- tabs -->
            <div class="flex gap-x-4">
                <Button @click="switchComponents('List','Daftar Kategori Pihak')" label="Daftar Kategori Pihak" :severity="currentTab==='List'?'primary':'secondary'" icon="pi pi-list" v-if="currentTab==='List'"/>
                <Button @click="cancelEdit()" label="Kembali" severity="secondary" icon="pi pi-arrow-left" v-else/>
                <Button @click="switchComponents('Form','Tambah Kategori Pihak')" label="Form Kategori Pihak" :severity="currentTab==='List'?'secondary':'primary'" icon="pi pi-plus"/>
            </div>
            <!-- components -->
            <div class="flex flex-col mt-4">
                <component :is="currentComponent" v-bind="componentProps" @refreshPage="refreshPage()" @editData="toggleEdit"/>
            </div>
        </template>
    </AuthenticatedLayout>
</template>

<style scoped>
</style>
