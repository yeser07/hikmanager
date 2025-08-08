<template>
    <Head title="Dashboard" />
    <AppLayout :breadcrumbs="breadcrumbs">
        <div class="flex h-full flex-1 flex-col gap-4 rounded-xl p-4 overflow-x-auto">
            <div class="mb-4 flex flex-col items-center justify-center space-y-2">
                <h1 class="text-2xl font-bold">Welcome to the Dashboard</h1>
                <p class="text-gray-600">Here you can manage your devices and monitor their status.</p>
            </div>
            <div class="grid auto-rows-min gap-4 md:grid-cols-3">
                <div v-for="device in devices" class="relative aspect-video overflow-hidden rounded-xl border border-sidebar-border/70 dark:border-sidebar-border flex flex-col items-center justify-center text-center space-y-2 device-card" :key="device.id"  @click="openAcsEventsReport(device.ip_address)">
                    <PlaceholderPattern />
                    <h1>
                        <span>{{ device.name }}</span>
                        <span class="align-middle ms-2 inline-block">
                            <component :is="Fingerprint" />
                        </span>
                    </h1>

                    <h1>
                        <span>Estado</span>
                        <span class="align-middle ms-2 inline-block">
                            <component :is="Check" />
                        </span>
                    </h1>
                    <h1>
                        <span>IP{{ device.ip_address }}</span>
                        <span class="align-middle ms-2 inline-block">
                            <component :is="Network" />
                        </span>
                    </h1>
                </div>
            </div>
        </div>
    </AppLayout>
</template>

<script setup lang="ts">
import AppLayout from '@/layouts/AppLayout.vue';
import { type BreadcrumbItem } from '@/types';
import { Head } from '@inertiajs/vue3';
import PlaceholderPattern from '../components/PlaceholderPattern.vue';
import { Check, Fingerprint, Folder, Network } from 'lucide-vue-next';
import { onMounted,ref } from 'vue';
import axios from 'axios'

const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'Dashboard',
        href: '/dashboard',
    },
];




const devices = ref([])

const getDevices = async () => {
  try {
    const response = await axios.get('/api/devices')
    devices.value = response.data
  } catch (error) {
    console.error('Error fetching devices:', error)
  }
}

function openAcsEventsReport(ip_address) {
  window.location.href = `/acs-events-report?ip_address=${ip_address}`;
}




onMounted(() => {
  getDevices();
});

</script>
<style>
.device-card {
    transition: transform 0.3s ease;
}

.device-card:hover {
    transform: scale(1.02);
    cursor: pointer;
}


</style>
