<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, Link } from '@inertiajs/vue3';

defineProps({
    providers: Object,
})

</script>

<template>
    <Head title="Dashboard" />

    <AuthenticatedLayout>
        <template #header>
            <h2
                class="text-xl font-semibold leading-tight text-gray-800"
            >
                Proveedores
            </h2>
            
        </template>

        <div class="py-12">
            <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
                <div>
                    <h2>Welcome</h2>
                    <br>
                    <Link :href="route('provider.create' )" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">Registrar un nuevo proveedor</Link>
                </div>
                <div>
                    <h2>Proveedores</h2>
                    <br>
                    <div>
                        <table class="w-full table-auto border-collapse">
                            <thead>
                                <tr class="bg-gray-200">
                                    <th class="px-4 py-2 text-left">Nombre</th>
                                    <th class="px-4 py-2 text-left">Direccion</th>
                                    <th class="px-4 py-2 text-left">Telefono</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="provider in providers.data" :key="provider.id"  class="border-b">
                                    <td class="px-4 py-2">
                                        {{ provider.nombre }}
                                    </td>
                                    <td class="px-4 py-2">
                                        {{ provider.direccion }}
                                    </td>
                                    <td class="px-4 py-2">
                                        {{ provider.telefono }}
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
