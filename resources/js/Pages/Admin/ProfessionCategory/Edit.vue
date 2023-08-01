<script setup>
import AdminLayout from '@/Layouts/Admin.vue';
import ProfessionCategoryForm from "@/Components/Admin/ProfessionCategoryForm.vue";

defineProps(['item']);
</script>

<template>
    <AdminLayout>
        <a-page-header title="Profession category edit" @back="$inertia.visit(route('admin.profession_category.index'))"/>
        <profession-category-form :item="item"/>
    </AdminLayout>
</template>
