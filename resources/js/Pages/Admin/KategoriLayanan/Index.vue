<script setup>
// import core api
import { computed, defineAsyncComponent, ref } from 'vue'

// import store / composables
import { useNotification } from '@/Composables/useNotification'

// import layout, components
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue'
import LoadingSpinner from '@/Components/LoadingSpinner.vue'

// variables, functions
const props = defineProps({
    data : Object
})

const { showToast } = useNotification()

const pageTitle = ref('Kategori Layanan')

const currentTab = ref('List')

const editDataId = ref(null)

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
            data: props.data?.map((p, i) => ({ nomor: i + 1, ...p })),
        };

        case 'Form' :
            if(editDataId.value) return { data : props.data?.find(data => data.id_kategori === editDataId.value) }
            return {}
        ;
        default:
        return {};
    }
})

const refreshPage = () =>
{
    showToast()
    switchComponents('List','Daftar Kategori')
}


</script>

<template>
    <AuthenticatedLayout :pageTitle="pageTitle">
        <template #pageContent>
            <!-- tabs -->
            <div class="flex gap-x-4">
                <Button @click="switchComponents('List','Daftar Kategori')" label="Daftar Kategori" :severity="currentTab==='List'?'primary':'secondary'" icon="pi pi-list"/>
                <Button @click="switchComponents('Form','Tambah Kategori')" label="Tambah Kategori" :severity="currentTab==='List'?'secondary':'primary'" icon="pi pi-plus"/>
            </div>
            <!-- components -->
            <div class="flex flex-col mt-4">
                <component :is="currentComponent" v-bind="componentProps" @refreshPage="refreshPage()"/>
            </div>
        </template>
    </AuthenticatedLayout>
</template>

<style scoped>
</style>
