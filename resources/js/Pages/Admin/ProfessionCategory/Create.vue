<script setup>
import AdminLayout from '@/Layouts/Admin.vue';
import ProfessionCategoryForm from "@/Components/Admin/ProfessionCategoryForm.vue";
</script>

<template>
    <AdminLayout>
        <a-page-header title="Profession category create" @back="$inertia.visit(route('admin.profession_category.index'))"/>
        <profession-category-form/>
    </AdminLayout>
</template>
