<template>
    <b-row class="g-3">
        <div class="col-md-3">
            <Sidebar :plan="plan" :folder_count="folders.data.length" :used="used" ref="sidebar"/>
        </div>
        <div class="col-md-9">
            <Main :plan="plan" :files="files.data" :folders="folders.data" ref="main"/>
        </div>
    </b-row>
</template>
<script>
import Main from './Components/Main.vue';
import Sidebar from './Components/Sidebar.vue';
export default {
    components: { Main, Sidebar },
    props: ['plan','used','folders','files']
}
</script>