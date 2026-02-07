<template>
  <DashboardLayout>
    
    <Dashboard_pages :Dashboard_pages="Dashboard_pages"/>
     <Shop :shops="shops" />
  </DashboardLayout>
</template>

<script setup>
import DashboardLayout from '@/Layouts/DashboardLayout.vue'
import Shop from "@/Pages/Shop/Shop.vue";
import Dashboard_pages from '@/Pages/Dashboard_pages.vue';
 

defineProps({
    shops: Array
});


</script>
