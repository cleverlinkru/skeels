<script setup>
import ImageUpload from '@/Components/Admin/ImageUpload.vue';
</script>

<template>
    <a-spin :spinning="form.processing">
        <a-form
            :model="form"
            :rules="rules"
            ref="form"
            :label-col="{ span: 24 }"
            :wrapper-col="{ span: 24 }"
            @finish="handleSubmit"
        >
            <a-form-item
                label="Name"
                name="name"
                :extra="form.errors.name"
            >
                <a-input v-model:value="form.name"/>
            </a-form-item>
            <a-form-item
                label="Image"
                name="image"
                :extra="form.errors.image"
            >
                <image-upload v-model:value="form.image_id" :url="form.image && form.image.url"/>
            </a-form-item>
            <a-form-item>
                <a-button type="primary" html-type="submit">Submit</a-button>
                <a-button class="cancel-button" @click="$inertia.visit(route('admin.profession_category.index'))">
                    Cancel
                </a-button>
            </a-form-item>
        </a-form>
    </a-spin>
</template>

<script>
import {useForm} from '@inertiajs/inertia-vue3';

export default {
    props: {
        item: {
            type: Object,
            required: true,
        },
    },
    data() {
        return {
            form: {},
            rules: {
                name: {
                    required: true,
                    message: 'Required',
                },
            },
        };
    },
    created() {
        this.form = useForm('profession_category', this.item ?? {
            name: '',
            image_id: null,
            image: {
                url: null,
            },
        });
    },
    methods: {
        handleSubmit() {
            if (this.item) {
                this.form.put(route('admin.profession_category.update', this.item.id));
            } else {
                this.form.post(route('admin.profession_category.store'));
            }
        },
    },
}
</script>

<style lang="scss" scoped>
.cancel-button {
    margin-left: 10px;
}
</style>
