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
                label="Description"
                name="description"
                :extra="form.errors.description"
            >
                <a-textarea v-model:value="form.description" :rows="4"/>
            </a-form-item>
            <a-form-item
                label="Time, min"
                name="time"
                :extra="form.errors.time"
            >
                <a-input-number v-model:value="form.time" :min="0" class="input-number"/>
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
                <a-button
                    class="cancel-button"
                    @click="$inertia.visit(route('admin.task.index'), { data: { work_day_id: work_day.id }})"
                >
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
            default: null,
        },
        work_day: {
            type: Object,
            default: null,
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
                description: {
                    required: true,
                    message: 'Required',
                },
            },
        };
    },
    created() {
        this.form = useForm('task', this.item ?? {
            name: '',
            description: '',
            time: '',
            work_day_id: this.work_day.id ?? null,
            image_id: null,
            image: {
                url: null,
            },
        });
    },
    methods: {
        handleSubmit() {
            if (this.item) {
                this.form.put(route('admin.task.update', this.item.id));
            } else {
                this.form.post(route('admin.task.store'));
            }
        },
    },
}
</script>

<style lang="scss" scoped>
.input-number {
    width: 100%;
}

.cancel-button {
    margin-left: 10px;
}
</style>
