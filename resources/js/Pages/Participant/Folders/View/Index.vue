<template>
    <Head :title="folder.name" />
    <PageHeader :title="folder.name" pageTitle="Folder" />
    <BRow>
        <BCol lg="3">
            <Sidebar :used="used" :folder="folder_data.data" ref="sidebar"/>
        </BCol>
        <BCol lg="9">
            <Main :folder="folder_data.data" ref="main"/>
        </BCol>
    </BRow>
</template>
<script>
import Main from './Components/Main.vue';
import Sidebar from './Components/Sidebar.vue';
import PageHeader from '@/Shared/Components/PageHeader.vue';
export default {
    components: { PageHeader, Sidebar, Main },
    props:['folder_data','used'],
    data(){
        return {
            currentUrl: window.location.origin,
            folder: this.folder_data.data
        }
    },
    methods: {
        back(){
            this.$inertia.visit('/folders');
        }
    }
}
</script>