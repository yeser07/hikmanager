<template>
  <Head title="Create Device" />
  <AppLayout :breadcrumbs="[{ title: 'Devices', href: route('devices.index') }]">
    <div class="create-device">
      <h1 class="text-5xl text-center">Add New Device</h1>
      <p class="text-center text-gray-600">Fill in the details below to add a new fingerprint device.</p>
      <hr><br>

      <form @submit.prevent="submitForm" class="max-w-md mx-auto">
        <div class="mb-4">
          <label for="name" class="block text-gray-700">Device Name</label>
          <input v-model="form.name" type="text" id="name" class="border px-3 py-2 rounded w-full"  />
          <p v-if="errors.name" class="text-red-500 text-sm">{{ errors.name }}</p>
        </div>

        <div class="mb-4">
          <label for="location" class="block text-gray-700">Location</label>
          <input v-model="form.location" type="text" id="location" class="border px-3 py-2 rounded w-full"  />
          <p v-if="errors.location" class="text-red-500 text-sm">{{ errors.location }}</p>
        </div>

        <div class="mb-4">
          <label for="operation" class="block text-gray-700">Operation</label>
          <input v-model="form.operation" type="text" id="operation" class="border px-3 py-2 rounded w-full"  />
          <p v-if="errors.operation" class="text-red-500 text-sm">{{ errors.operation }}</p>
        </div>

        <div class="mb-4">
          <label for="ip_address" class="block text-gray-700">IP Address</label>
          <input v-model="form.ip_address" type="text" id="ip_address" class="border px-3 py-2 rounded w-full"  />
          <p v-if="errors.ip_address" class="text-red-500 text-sm">{{ errors.ip_address }}</p>
        </div>

        <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded w-full">
          Save Device
        </button>
      </form>
    </div>
  </AppLayout>
</template>

<script setup>
import { ref } from 'vue'
import { Head } from '@inertiajs/vue3'
import AppLayout from '@/layouts/AppLayout.vue'
import axios from 'axios'
import Swal from 'sweetalert2'

const form = ref({
  name: '',
  location: '',
  operation: '',
  ip_address: '',
})

const errors = ref({})

const submitForm = async () => {

    if (!formInputValidation()) {
        return;
    }


  try {
    await axios.post('/api/devices', form.value)

    Swal.fire({
      icon: 'success',
      title: 'Device Created',
      text: 'The device has been added successfully!',
      confirmButtonColor: '#3085d6'
    }).then(() => {
      window.location.href = route('devices.index')
    })
  } catch (error) {
    if (error.response?.status === 422) {
        errors.value = error.response.data.errors
        const firstError = Object.values(errors.value)[0]?.[0] || 'Please fix the highlighted fields.'

        Swal.fire({
        icon: 'error',
        title: 'Validation Error',
        text: firstError,
        confirmButtonColor: '#d33'
        })

    } else {
            const backendMessage =
            error.response?.data?.error ||
            error.response?.data?.message ||
            'Failed to create device. Try again later.'

            Swal.fire({
            icon: 'error',
            title: 'Server Error',
            text: backendMessage,
            confirmButtonColor: '#d33'
            })
        }
    }
}

function formInputValidation() {
    let name = form.value.name.trim();
    let location = form.value.location.trim();
    let operation = form.value.operation.trim();
    let ip_address = form.value.ip_address.trim();
    let valid = true;
    errors.value = {};
    if (!name) {
        errors.value.name = "Name is required.";
        valid = false;
    }
    if (!location) {
        errors.value.location = "Location is required.";
        valid = false;
    }
    if (!operation) {
        errors.value.operation = "Operation is required.";
        valid = false;
    }
    if (!ip_address) {
        errors.value.ip_address = "IP Address is required.";
        valid = false;
    }
    return valid;
}
</script>
