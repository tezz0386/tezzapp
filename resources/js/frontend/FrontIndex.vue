<template>
    <div class="wrapper">
        <frontend-header/>
        <front-banner/>
        <main-content />
        <frontend-footer/>
    </div>
</template>
<script>
import MainContent from './main/MainContent.vue'
import FrontBanner from './shared/FrontBanner.vue'
import FrontendHeader from './shared/FrontendHeader.vue'
import FrontendFooter from './shared/FrontendFooter.vue'
export default {
  components: { FrontendHeader, FrontBanner, MainContent, FrontendFooter },
    name:'FrontIndex',
}
</script>