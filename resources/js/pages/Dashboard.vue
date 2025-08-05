<script setup lang="ts">
import AppLayout from '@/layouts/AppLayout.vue';
import { type BreadcrumbItem } from '@/types';
import { Head } from '@inertiajs/vue3';
import PlaceholderPattern from '../components/PlaceholderPattern.vue';
import { Check, Fingerprint, Folder, Network } from 'lucide-vue-next';

const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'Dashboard',
        href: '/dashboard',
    },
];
</script>

<template>
    <Head title="Dashboard" />

    <AppLayout :breadcrumbs="breadcrumbs">
        <div class="flex h-full flex-1 flex-col gap-4 rounded-xl p-4 overflow-x-auto">
            <div class="grid auto-rows-min gap-4 md:grid-cols-3">
                <div class="relative aspect-video overflow-hidden rounded-xl border border-sidebar-border/70 dark:border-sidebar-border flex flex-col items-center justify-center text-center space-y-2">
                    <PlaceholderPattern />

                    <h1>
                        <span>Dispositivo 1</span>
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
                        <span>Dirección IP: 237.84.2.178</span>
                        <span class="align-middle ms-2 inline-block">
                            <component :is="Network" />
                        </span>
                    </h1>
                </div>
                <div class="relative aspect-video overflow-hidden rounded-xl border border-sidebar-border/70 dark:border-sidebar-border flex flex-col items-center justify-center text-center space-y-2">
                    <PlaceholderPattern />

                    <h1>
                        <span>Dispositivo 1</span>
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
                        <span>Dirección IP: 237.84.2.178</span>
                        <span class="align-middle ms-2 inline-block">
                            <component :is="Network" />
                        </span>
                    </h1>
                </div>
                <div class="relative aspect-video overflow-hidden rounded-xl border border-sidebar-border/70 dark:border-sidebar-border flex flex-col items-center justify-center text-center space-y-2">
                    <PlaceholderPattern />

                    <h1>
                        <span>Dispositivo 1</span>
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
                        <span>Dirección IP: 237.84.2.178</span>
                        <span class="align-middle ms-2 inline-block">
                            <component :is="Network" />
                        </span>
                    </h1>
                </div>
            </div>
            <div class="relative min-h-[100vh] flex-1 rounded-xl border border-sidebar-border/70 md:min-h-min dark:border-sidebar-border">
                <PlaceholderPattern />
                <table class="w-full border-collapse text-center text-sm ">
                    <thead>
                        <tr>
                            <th class="px-4 py-2">Column 1</th>
                            <th class="px-4 py-2">Column 2</th>
                            <th class="px-4 py-2">Column 3</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white dark:bg-gray-800 text-center">
                        <tr>
                            <td class="px-4 py-2">Data 1</td>
                            <td class="px-4 py-2">Data 2</td>
                            <td class="px-4 py-2">Data 3</td>
                        </tr>
                        <!-- Add more rows as needed -->
                    </tbody>
                </table>
            </div>
        </div>
    </AppLayout>
</template>
