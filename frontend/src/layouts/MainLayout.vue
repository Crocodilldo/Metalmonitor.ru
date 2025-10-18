
<template>
  <div class="min-h-screen flex flex-col">
    <Navbar v-model="showAuth" />
    <main>
      <AuthForm v-if="showAuth" @close="showAuth = false" />
        <router-view v-else></router-view>
    </main>
    <Footer />
  </div>
</template>

<script setup>
import { ref } from 'vue'
import Footer from '@/components/Footer.vue';
import Navbar from '@/components/Navbar.vue';
import AuthForm from '@/components/AuthForm.vue';
const showAuth = ref(false)
</script>

<style>

</style>