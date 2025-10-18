
<template>
  <div class="min-h-screen flex flex-col">
    <Navbar v-model="showAuth" />
    <div class="flex">
      <Sidebar />
    <main class="flex-1 p-6 overflow-y-auto">
      <router-view />
    </main>
    </div>
    <Footer />
  </div>
</template>

<script setup>
import { ref } from 'vue'
import Footer from '@/components/Footer.vue'
import Navbar from '@/components/Navbar.vue'
import Sidebar from '@/components/Sidebar.vue'
import { useAuthStore } from '@/stores/authStore'
import { onMounted } from 'vue'
import { useRouter } from 'vue-router'

const showAuth = ref(false)
const authStore = useAuthStore()
const router = useRouter()

onMounted(() => {
  if (!authStore.user) {
    router.push('/') // если не авторизован
  }
})
</script>

<style>
</style>