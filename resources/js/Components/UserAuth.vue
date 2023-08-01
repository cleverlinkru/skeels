<template>
    <a-button @click="handleClick">Exit</a-button>
    {{ $page.props.auth.user.name }}
</template>

<script>
export default {
    methods: {
        handleClick() {
            this.$inertia.visit(route('auth.destroy'));
        },
    },
}
</script>
