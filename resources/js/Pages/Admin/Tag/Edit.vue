<script setup>
import AdminLayout from '@/Layouts/Admin.vue';
import TagForm from "@/Components/Admin/TagForm.vue";

defineProps(['item']);
</script>

<template>
    <AdminLayout>
        <a-page-header title="Tag edit" @back="$inertia.visit(route('admin.tag.index'))"/>
        <tag-form :item="item"/>
    </AdminLayout>
</template>
