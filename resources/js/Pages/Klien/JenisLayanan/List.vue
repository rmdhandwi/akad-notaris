<script setup>


// lifecycle hooks

// variables, functions
const props = defineProps({
    dataJenisLayanan : Object,
})

</script>

<template>
    <div class="border border-blue-500 rounded-md min-h-fit p-4">
        <div v-if="props.dataJenisLayanan">
            <h1 class="text-xl"> <i class="pi pi-info-circle"></i> Syarat Berkas untuk layanan : {{ props.dataJenisLayanan?.nama_jenis }}</h1>
            <div class="flex flex-col gap-y-4 p-2" v-for="kategoriPihak in props.dataJenisLayanan?.kategori_pihak">
                <div class="flex flex-col">
                    <h2 class="text-lg">{{ 'Pihak '+kategoriPihak.nama_kategori_pihak + ' :'}}</h2>
                    <div class="flex flex-col gap-y-2 px-4" v-for="berkas in kategoriPihak.data_berkas">
                        <span>{{ '- '+berkas.nama_berkas }}</span>
                    </div>
                </div>
            </div>
        </div>
        <div v-else>
            <h1 class="text-xl"><i class="pi pi-info-circle"></i> Silahkan pilih jenis layanan untuk melihat persyaratan yang dibutuhkan.</h1>
        </div>
    </div>
</template>

<style scoped>
</style>
