<template>
    <a-select
        :value="list"
        @update:value="handleUpdateValue"
        mode="multiple"
        placeholder="Select"
        :filter-option="false"
        :options="options"
        @search="handleSearch"
    />
</template>

<script>
import axios from "axios";

const searchDelay = 500;

export default {
    props: {
        value: {
            type: Array,
            default: [],
        },
    },
    data() {
        return {
            list: [],
            options: [],
            timeout: null,
        };
    },
    created() {
        this.list = this.value.map((item) => item.id);
        this.loadOptions();
    },
    methods: {
        handleUpdateValue(val) {
            this.list = val;
            this.$emit('update:value', val.map((item) => ({id: item})));
        },

        handleSearch(phrase) {
            clearTimeout(this.timeout);
            this.timeout = setTimeout(() => {
                this.loadOptions(phrase);
            }, searchDelay);
        },

        loadOptions(phrase = null) {
            axios.post(route('admin.tag.select_search'), {
                phrase: phrase,
                ids: this.list
            }).then((response) => {
                this.options = response.data.items.map((item) => ({
                    label: item.id + ' : ' + item.name,
                    value: item.id,
                }));
            });
        },
    },
}
</script>
