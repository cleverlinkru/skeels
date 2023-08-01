<script setup>
import AuthLayout from '@/Layouts/Auth.vue';
</script>

<template>
    <AuthLayout>
        <a-spin :spinning="form.processing">
            <a-card>
                <a-tabs>
                    <a-tab-pane key='sign-in' tab='SignIn'>
                        <a-form
                            :model='form'
                            :rules='rules'
                            :label-col="{ span: 8 }"
                            :wrapper-col="{ span: 16 }"
                            @finish='onSignIn'
                        >
                            <a-form-item label='Username' name='name' :extra='form.errors.name'>
                                <a-input v-model:value='form.name'/>
                            </a-form-item>
                            <a-form-item label='Password' name='password' :extra='form.errors.password'>
                                <a-input-password v-model:value='form.password'/>
                            </a-form-item>
                            <a-form-item :wrapper-col="{ offset: 8, span: 16 }">
                                <a-button type="primary" html-type="submit">SignIn</a-button>
                            </a-form-item>
                        </a-form>
                    </a-tab-pane>
                    <a-tab-pane key='sign-up' tab='SignUp'>
                        <a-form
                            :model='form'
                            :rules='rules'
                            :label-col="{ span: 8 }"
                            :wrapper-col="{ span: 16 }"
                            @finish='onSignUp'
                        >
                            <a-form-item label='Username' name='name' :extra='form.errors.name'>
                                <a-input v-model:value='form.name'/>
                            </a-form-item>
                            <a-form-item label='Password' name='password' :extra='form.errors.password'>
                                <a-input-password v-model:value='form.password'/>
                            </a-form-item>
                            <a-form-item label='Password confirm' name='password_confirm'>
                                <a-input-password v-model:value='form.password_confirm'/>
                            </a-form-item>
                            <a-form-item :wrapper-col="{ offset: 8, span: 16 }">
                                <a-button type="primary" html-type="submit">SignUp</a-button>
                            </a-form-item>
                        </a-form>
                    </a-tab-pane>
                </a-tabs>
            </a-card>
        </a-spin>
    </AuthLayout>
</template>

<script>
import {useForm} from "@inertiajs/inertia-vue3";

export default {
    data() {
        return {
            form: {},
            rules: {
                name: {
                    required: true,
                    message: 'Required',
                },
                password: {
                    required: true,
                    message: 'Required',
                },
                password_confirm: [
                    {
                        required: true,
                        message: 'Required',
                    },
                    {
                        validator: (rule, value) => {
                            if (this.form.password !== value) {
                                return Promise.reject('Not match');
                            }
                            return Promise.resolve();
                        },
                        trigger: "change",
                    },
                ],
            },
        };
    },
    created() {
        this.form = useForm('authForm', {
            name: '',
            password: '',
        });
    },
    methods: {
        onSignIn() {
            this.form.post(route('auth.store'), {
                onFinish: () => this.form.reset('password'),
            });
        },

        onSignUp() {
            this.form.post(route('user.store'), {
                onFinish: () => this.form.reset('password'),
            });
        },
    },
}
</script>
