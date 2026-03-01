<template>
    <PageHeader title="Dashboard" pageTitle="Menu" />
    <b-row class="g-3">
        <div class="col-md-3">
            <Sidebar ref="sidebar"/>
        </div>
        <div class="col-md-9">
            <Main :folders="folders.data" ref="main"/>
        </div>
    </b-row>
</template>
<script>
import Main from './Components/Main.vue';
import Sidebar from './Components/Sidebar.vue';
import PageHeader from '@/Shared/Components/PageHeader.vue';
export default {
    components: { PageHeader, Main, Sidebar },
    props: ['folders']
}
</script>