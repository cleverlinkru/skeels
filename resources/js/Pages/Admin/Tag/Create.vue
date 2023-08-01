<script setup>
import AdminLayout from '@/Layouts/Admin.vue';
import TagForm from "@/Components/Admin/TagForm.vue";
</script>

<template>
    <AdminLayout>
        <a-page-header title="Tag create" @back="$inertia.visit(route('admin.tag.index'))"/>
        <tag-form/>
    </AdminLayout>
</template>
