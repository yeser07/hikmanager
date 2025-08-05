<template>
<Head title="Devices" />
<AppLayout :breadcrumbs="[{ title: 'Devices', href: route('devices.index') }]">
    <div class="device-index">
        <h1>Dispositivos Fingerprint</h1>
        <button @click="openForm()">Registrar Dispositivo</button>
        <table>
            <thead>
                <tr>
                    <th>Nombre</th>
                    <th>Localidad</th>
                    <th>Operación</th>
                    <th>Dirección IP</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="device in devices" :key="device.id">
                    <td>{{ device.nombre }}</td>
                    <td>{{ device.localidad }}</td>
                    <td>{{ device.operacion }}</td>
                    <td>{{ device.direccionip }}</td>
                    <td>
                        <button @click="openForm(device)">Editar</button>
                        <button @click="deleteDevice(device.id)">Eliminar</button>
                    </td>
                </tr>
            </tbody>
        </table>

        <div v-if="showForm" class="modal">
            <div class="modal-content">
                <h2>{{ form.id ? 'Editar' : 'Registrar' }} Dispositivo</h2>
                <form @submit.prevent="saveDevice">
                    <label>
                        Nombre:
                        <input v-model="form.nombre" required />
                    </label>
                    <label>
                        Localidad:
                        <input v-model="form.localidad" required />
                    </label>
                    <label>
                        Operación:
                        <input v-model="form.operacion" required />
                    </label>
                    <label>
                        Dirección IP:
                        <input v-model="form.direccionip" required />
                    </label>
                    <div class="actions">
                        <button type="submit">Guardar</button>
                        <button type="button" @click="closeForm">Cancelar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</AppLayout>
</template>

<script >

import { Head } from '@inertiajs/vue3';


export default {
    name: 'DevicesIndex',
    data() {
        return {
            devices: [],
            showForm: false,
            form: {
                id: null,
                nombre: '',
                localidad: '',
                operacion: '',
                direccionip: ''
            }
        };

    },


    components: {
        AppLayout,
        Head
    },

    methods: {
        openForm(device = null) {
            if (device) {
                this.form = { ...device };
            } else {
                this.form = {
                    id: null,
                    nombre: '',
                    localidad: '',
                    operacion: '',
                    direccionip: ''
                };
            }
            this.showForm = true;
        },
        closeForm() {
            this.showForm = false;
        },
        saveDevice() {
            if (this.form.id) {
                // Editar
                const idx = this.devices.findIndex(d => d.id === this.form.id);
                if (idx !== -1) this.devices.splice(idx, 1, { ...this.form });
            } else {
                // Registrar
                this.devices.push({
                    ...this.form,
                    id: Date.now()
                });
            }
            this.closeForm();
        },
        deleteDevice(id) {
            this.devices = this.devices.filter(d => d.id !== id);
        }
    },

};
</script>

<style scoped>
.device-index {
    max-width: 800px;
    margin: 0 auto;
}
table {
    width: 100%;
    border-collapse: collapse;
    margin-top: 1em;
}
th, td {
    border: 1px solid #ccc;
    padding: 0.5em;
    text-align: left;
}
button {
    margin-right: 0.5em;
}
.modal {
    position: fixed;
    top: 0; left: 0; right: 0; bottom: 0;
    background: rgba(0,0,0,0.3);
    display: flex;
    align-items: center;
    justify-content: center;
}
.modal-content {
    background: #fff;
    padding: 2em;
    border-radius: 8px;
    min-width: 300px;
}
.actions {
    margin-top: 1em;
}
</style>
