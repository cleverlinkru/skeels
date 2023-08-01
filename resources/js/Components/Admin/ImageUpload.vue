<template>
    <a-upload
        v-model:file-list="fileList"
        name="file"
        list-type="picture-card"
        :action="route('attachment.store')"
        :headers="{ 'x-csrf-token': $page.props.token }"
        :max-count="1"
        :show-upload-list="{ showPreviewIcon: false }"
        @change="handleChange"
        @remove="handleRemove"
    >
        <loading-outlined v-if="loading"/>
        <plus-outlined v-else/>
        <div class="ant-upload-text">Upload</div>
    </a-upload>
</template>

<script>
import {LoadingOutlined, PlusOutlined} from '@ant-design/icons-vue';

export default {
    props: {
        value: {
            type: Number,
            default: null,
        },
        url: null,
    },
    components: {
        LoadingOutlined,
        PlusOutlined,
    },
    data() {
        return {
            loading: false,
            fileList: [],
        };
    },
    created() {
        if (this.url) {
            this.fileList = [
                {
                    thumbUrl: this.url,
                },
            ];
        }
    },
    methods: {
        handleChange(info) {
            if (info.file.status == 'done') {
                this.$emit('update:value', info.file.response.id);
                this.loading = false;
            } else if (info.file.status == 'uploading') {
                this.loading = true;
            } else if (info.file.status == 'error') {
                this.loading = false;
            }
        },

        handleRemove(file) {
            this.$emit('update:value', null);
        },
    },
}
</script>
