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
            <a-form-item>
                <a-button type="primary" html-type="submit">Submit</a-button>
                <a-button
                    class="cancel-button"
                    @click="$inertia.visit(route('admin.work_day.index'), { data: { profession_id: profession.id }})"
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
        profession: {
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
            },
        };
    },
    created() {
        this.form = useForm('work_day', this.item ?? {
            name: '',
            profession_id: this.profession.id ?? null,
        });
    },
    methods: {
        handleSubmit() {
            if (this.item) {
                this.form.put(route('admin.work_day.update', this.item.id));
            } else {
                this.form.post(route('admin.work_day.store'));
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
