<template>
    <AppLayout :breadcrumbs="breadcrumbs">
        <Head title="ACS Events Report" />
            <h1 class="text-2xl font-semibold text-gray-900 text-center">ACS Events Report</h1>
            <p class="text-gray-600 text-center">This page will display the ACS events report.</p>
            <h1 class="text-2xl font-semibold text-gray-900 text-center">
                Device IP: {{ ip_address }}
            </h1>
            <br>
            <!-- Filters Card by date -->
            <div class="flex flex-col items-center justify-center mt-4">
            <div class="w-full max-w-lg p-4  rounded-lg shadow-md">
                <h2 class="text-lg font-semibold mb-4">Filter by Date</h2>
                <div class="flex flex-col sm:flex-row sm:space-x-4 space-y-4 sm:space-y-0">

                <!-- Start Date -->
                <div class="flex flex-col flex-1">
                    <label for="start_date" class="block text-sm font-medium text-gray-700">
                    Start Date
                    </label>
                    <input
                    type="date"
                    id="start_date"
                    v-model="startDate"
                    @change="filterByDate"
                    class="p-2 border border-gray-300 rounded-md"
                    required
                    >
                </div>

                <!-- End Date -->
                <div class="flex flex-col flex-1">
                    <label for="end_date" class="block text-sm font-medium text-gray-700">
                    End Date
                    </label>
                    <input
                    type="date"
                    id="end_date"
                    v-model="endDate"
                    @change="filterByDate"
                    class="p-2 border border-gray-300 rounded-md"
                    required
                    >
                </div>

                </div>
            </div>
            </div>


    </AppLayout>
</template>
<script setup lang="ts">

import AppLayout from '@/layouts/AppLayout.vue';
import { type BreadcrumbItem } from '@/types';
import { Head } from '@inertiajs/vue3';
import { ref,Ref } from 'vue';

const breadcrumbs: BreadcrumbItem[] = [

    {
        title: 'ACS Events Report',
        href: '/reports/acs-events',
    },
];

const queryUrl = new URL(window.location.href);
const ip_address = queryUrl.searchParams.get('ip_address');

const today = new Date();

const getTodayDate = (): string => {
  const today = new Date();
  const pad = (n: number) => String(n).padStart(2, '0');
  return `${today.getFullYear()}-${pad(today.getMonth() + 1)}-${pad(today.getDate())}`;
};

// valores iniciales para los inputs
const startDate: Ref<string> = ref(getTodayDate());
const endDate: Ref<string> = ref(getTodayDate());



const filterByDate = () => {
    if (startDate.value && endDate.value) {
        // Logic to filter the ACS events by date
        console.log(`Filtering events from ${startDate.value} to ${endDate.value}`);
        // You can implement the API call or filtering logic here
    } else {
        console.log('Please select both start and end dates.');
    }
};


</script>
