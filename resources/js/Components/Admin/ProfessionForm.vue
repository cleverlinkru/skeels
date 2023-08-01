<script setup>
import ProfessionCategoriesSelect from "@/Components/Admin/ProfessionCategoriesSelect.vue";
import TagsSelect from "@/Components/Admin/TagsSelect.vue";
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
                label="Image"
                name="image"
                :extra="form.errors.image"
            >
                <image-upload v-model:value="form.image_id" :url="form.image && form.image.url"/>
            </a-form-item>
            <a-form-item
                label="Salary"
                name="salary"
                :extra="form.errors.salary"
            >
                <a-input-number v-model:value="form.salary" :min="0" class="input-number"/>
            </a-form-item>
            <a-form-item
                label="Salary up"
                name="salary_up"
                :extra="form.errors.salary_up"
            >
                <a-input-number v-model:value="form.salary_up" :min="0" class="input-number"/>
            </a-form-item>
            <a-form-item
                label="Salary down"
                name="salary_down"
                :extra="form.errors.salary_down"
            >
                <a-input-number v-model:value="form.salary_down" :min="0" class="input-number"/>
            </a-form-item>
            <a-form-item
                label="Categories"
                name="categories"
                :extra="form.errors.categories"
            >
                <profession-categories-select v-model:value="form.categories"/>
            </a-form-item>
            <a-form-item
                label="Tags"
                name="tags"
                :extra="form.errors.tags"
            >
                <tags-select v-model:value="form.tags"/>
            </a-form-item>
            <a-form-item
                label="Popularity, %"
                name="popularity"
                :extra="form.errors.popularity"
            >
                <a-input-number v-model:value="form.popularity" :min="0" :max="100" class="input-number"/>
            </a-form-item>
            <a-form-item
                label="Demand, %"
                name="demand"
                :extra="form.errors.demand"
            >
                <a-input-number v-model:value="form.demand" :min="0" :max="100" class="input-number"/>
            </a-form-item>
            <a-form-item
                label="Perspective, %"
                name="perspective"
                :extra="form.errors.perspective"
            >
                <a-input-number v-model:value="form.perspective" :min="0" :max="100" class="input-number"/>
            </a-form-item>
            <a-form-item
                label="Demand change"
                name="demand_change"
                :extra="form.errors.demand_change"
            >
                <a-select v-model:value="form.demand_change">
                    <a-select-option :value="null">No select</a-select-option>
                    <a-select-option :value="true">Up</a-select-option>
                    <a-select-option :value="false">Down</a-select-option>
                </a-select>
            </a-form-item>
            <a-form-item>
                <a-button type="primary" html-type="submit">Submit</a-button>
                <a-button class="cancel-button" @click="$inertia.visit(route('admin.profession.index'))">Cancel
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
                description: {
                    required: true,
                    message: 'Required',
                },
                salary: {
                    required: true,
                    message: 'Required',
                },
            },
        };
    },
    created() {
        this.form = useForm('profession', this.item ?? {
            name: '',
            description: '',
            image_id: null,
            image: {
                url: null,
            },
            salary: '',
            salary_up: '',
            salary_down: '',
            categories: [],
            tags: [],
            popularity: '',
            demand: '',
            perspective: '',
            demand_change: null,
        });
    },
    methods: {
        handleSubmit() {
            if (this.item) {
                this.form.put(route('admin.profession.update', this.item.id));
            } else {
                this.form.post(route('admin.profession.store'));
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
