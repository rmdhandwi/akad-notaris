<script setup>
import { Head, useForm } from '@inertiajs/vue3'

// import layout
import GuestLayout from '@/Layouts/GuestLayout.vue'

// lifecycle hooks

const loginForm = useForm({
    username: '',
    password: '',
});

const submit = () => {
    loginForm.post(route('user.login'), {
        onSuccess: () => loginForm.reset(),
    });
};
</script>

<template>
    <GuestLayout>
        <Head title="Login"/>
        <div class="flex flex-col bg-slate-50 border-2 px-6 py-8 gap-y-4 rounded-lg">
            <span class="text-2xl text-center">SISTEM INFORMASI PENJADWALAN AKAD</span>
            <form @submit.prevent class="flex flex-col gap-y-4" autocomplete="off">
                <div>
                    <FloatLabel variant="on">
                        <InputText autofocus id="username_input" v-model="loginForm.username" fluid/>
                        <label for="username_input">Username</label>
                    </FloatLabel>
                    <span class="text-sm text-red-500 mx-2" v-if="loginForm.errors.username">
                        {{ loginForm.errors.username }}
                    </span>
                </div>
                <div>
                    <FloatLabel variant="on">
                        <Password id="password_input" v-model="loginForm.password" toggleMask fluid/>
                        <label for="password_input">Password</label>
                    </FloatLabel>
                    <span class="text-sm text-red-500 mx-2" v-if="loginForm.errors.password">
                        {{ loginForm.errors.password }}
                    </span>
                </div>
                <Button
                    @click="submit"
                    :label="!loginForm.processing?'LOGIN':null"
                    :loading="loginForm.processing"
                    :disabled="!loginForm.username||!loginForm.password||loginForm.processing"
                />
            </form>
        </div>

    </GuestLayout>
</template>
