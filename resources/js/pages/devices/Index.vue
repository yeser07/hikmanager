<template>
  <Head title="Devices" />
  <AppLayout :breadcrumbs="[{ title: 'Devices', href: route('devices.index') }]">
    <div class="device-index">
      <h1 class="text-5xl text-center">Fingerprint devices</h1>
      <p class="text-center text-gray-600">Manage your fingerprint devices here.</p>
      <hr><br>

      <div class="flex justify-center mb-4">
        <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded" @click="openForm()">
          Add Device <span class="ml-2">+</span>
        </button>
      </div>
      <!-- Search input -->
      <div class="mt-4 flex justify-center">
        <input
          v-model="search"
          placeholder="Search..."
          class="border px-3 py-2 rounded w-1/3"
        />
      </div>
      <br>
      <EasyDataTable
        class="rounded-lg"
        :headers="headers"
        :items="devices"
        :rows-per-page="5"
        show-index
        :search-value="search"
      >
        <template #item-actions="{ item }">
          <button @click="openForm(item)" class="bg-yellow-500 text-white px-3 py-1 rounded hover:bg-yellow-600 ml-2 pointer cursor-pointer">
            <i class="fas fa-edit"></i>
          </button>

          <button @click="deleteDevice(item.id)" class="bg-red-500 text-white px-3 py-1 rounded hover:bg-red-600 ml-2 pointer cursor-pointer">
            <i class="fas fa-trash-alt"></i>
          </button>
        </template>
      </EasyDataTable>
    </div>
  </AppLayout>
</template>

<script setup>
import { onMounted, ref } from 'vue'
import axios from 'axios'
import { Head } from '@inertiajs/vue3'
import AppLayout from '@/layouts/AppLayout.vue'
import EasyDataTable from 'vue3-easy-data-table'
import 'vue3-easy-data-table/dist/style.css'

const search = ref('')

const devices = ref([])

const headers = [
  { text: 'Name', value: 'name' },
  { text: 'Location', value: 'location' },
  { text: 'Operation', value: 'operation' },
  { text: 'IP Address', value: 'ip_address' },
  { text: 'Actions', value: 'actions', sortable: false }
]


const getDevices = async () => {
  try {
    const response = await axios.get('/api/devices')
    devices.value = response.data
  } catch (error) {
    console.error('Error fetching devices:', error)
  }
}

onMounted(() => {
  getDevices()
})

const openForm = () => {
  window.location.href = route('devices.create')

}

const deleteDevice = (id) => {
  // tu lógica para eliminar dispositivo
}
</script>
